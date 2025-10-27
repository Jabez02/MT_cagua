class ChatApp {
    constructor() {
        this.currentConversationId = null;
        this.typingTimer = null;
        this.isTyping = false;
        this.lastMessageId = null;
        this.conversations = new Map();
        this.messageContainer = document.getElementById('messagesList');
        this.messageInput = document.getElementById('messageInput');
        this.sendBtn = document.getElementById('sendBtn');
        this.conversationsList = document.getElementById('conversationsList');
        
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.loadConversations();
        this.setupWebSocket();
        this.autoResizeTextarea();
    }

    setupEventListeners() {
        // Message form submission
        document.getElementById('messageForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.sendMessage();
        });

        // Message input events
        this.messageInput.addEventListener('input', () => {
            this.handleTyping();
            this.autoResizeTextarea();
        });

        this.messageInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });

        // File attachment
        document.getElementById('attachFileBtn').addEventListener('click', () => {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', (e) => {
            this.handleFileSelection(e.target.files[0]);
        });

        // New chat modal (for users)
        if (window.chatConfig.userRole !== 'admin') {
            document.getElementById('newChatBtn').addEventListener('click', () => {
                this.showNewChatModal();
            });

            document.getElementById('startChatBtn').addEventListener('click', () => {
                this.startNewChat();
            });
        }

        // Cancel reply
        document.getElementById('cancelReplyBtn').addEventListener('click', () => {
            this.cancelReply();
        });

        // Message actions (delegated event handling)
        document.addEventListener('click', (e) => {
            if (e.target.closest('.message-bubble')) {
                this.handleMessageClick(e);
            }
            
            if (e.target.closest('.reaction-item')) {
                this.handleReactionClick(e);
            }
            
            if (e.target.closest('.attachment-file, .attachment-image')) {
                this.handleAttachmentClick(e);
            }
        });

        // Context menu for messages
        document.addEventListener('contextmenu', (e) => {
            if (e.target.closest('.message-bubble')) {
                e.preventDefault();
                this.showMessageContextMenu(e);
            }
        });
    }

    async loadConversations() {
        try {
            const response = await fetch(window.chatConfig.routes.conversations, {
                headers: {
                    'X-CSRF-TOKEN': window.chatConfig.csrfToken,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Failed to load conversations');

            const data = await response.json();
            this.renderConversations(data.conversations);
        } catch (error) {
            console.error('Error loading conversations:', error);
            this.showError('Failed to load conversations');
        }
    }

    renderConversations(conversations) {
        this.conversationsList.innerHTML = '';
        
        if (conversations.length === 0) {
            this.conversationsList.innerHTML = `
                <div class="no-conversations">
                    <p>No conversations yet</p>
                    ${window.chatConfig.userRole !== 'admin' ? '<p>Start a new chat to get help!</p>' : ''}
                </div>
            `;
            return;
        }

        conversations.forEach(conversation => {
            this.conversations.set(conversation.id, conversation);
            const conversationElement = this.createConversationElement(conversation);
            this.conversationsList.appendChild(conversationElement);
        });
    }

    createConversationElement(conversation) {
        const div = document.createElement('div');
        div.className = 'conversation-item';
        div.dataset.conversationId = conversation.id;
        
        const otherParticipant = conversation.participant;
        const lastMessage = conversation.latest_message;
        const unreadCount = conversation.unread_count || 0;

        div.innerHTML = `
            <div class="conversation-header">
                <div class="conversation-name">${otherParticipant ? otherParticipant.name : 'Unknown User'}</div>
                <div class="conversation-time">${lastMessage ? this.formatTime(lastMessage.created_at) : ''}</div>
            </div>
            <div class="conversation-preview">
                ${lastMessage ? this.formatMessagePreview(lastMessage) : 'No messages yet'}
            </div>
            ${unreadCount > 0 ? `<div class="unread-badge">${unreadCount}</div>` : ''}
        `;

        div.addEventListener('click', () => {
            this.selectConversation(conversation.id);
        });

        return div;
    }

    async selectConversation(conversationId) {
        // Unsubscribe from previous conversation
        if (this.currentConversationId && typeof Echo !== 'undefined') {
            this.unsubscribeFromConversation(this.currentConversationId);
        }

        // Update UI
        document.querySelectorAll('.conversation-item').forEach(item => {
            item.classList.remove('active');
        });
        
        const selectedItem = document.querySelector(`[data-conversation-id="${conversationId}"]`);
        if (selectedItem) {
            selectedItem.classList.add('active');
            // Remove unread badge
            const unreadBadge = selectedItem.querySelector('.unread-badge');
            if (unreadBadge) unreadBadge.remove();
        }

        this.currentConversationId = conversationId;
        document.getElementById('conversationId').value = conversationId;

        // Subscribe to new conversation
        if (typeof Echo !== 'undefined') {
            this.subscribeToConversation(conversationId);
        }

        // Show chat area
        document.getElementById('chatWelcome').style.display = 'none';
        document.getElementById('chatArea').style.display = 'flex';

        // Update participant info
        const conversation = this.conversations.get(conversationId);
        if (conversation) {
            const otherParticipant = conversation.participant;
            document.getElementById('participantName').textContent = otherParticipant ? otherParticipant.name : 'Unknown User';
        }

        // Load messages
        await this.loadMessages(conversationId);
    }

    async loadMessages(conversationId, page = 1) {
        try {
            const url = window.chatConfig.routes.messages.replace(':id', conversationId) + `?page=${page}`;
            const response = await fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': window.chatConfig.csrfToken,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Failed to load messages');

            const data = await response.json();
            
            if (page === 1) {
                this.messageContainer.innerHTML = '';
            }
            
            // Fix: Use data.messages directly, not data.messages.data
            this.renderMessages(data.messages || [], page === 1);
            
            if (page === 1) {
                this.scrollToBottom();
            }
        } catch (error) {
            console.error('Error loading messages:', error);
            this.showError('Failed to load messages');
        }
    }

    renderMessages(messages, scrollToBottom = false) {
        messages.forEach(message => {
            const messageElement = this.createMessageElement(message);
            this.messageContainer.appendChild(messageElement);
        });

        if (scrollToBottom) {
            this.scrollToBottom();
        }
    }

    createMessageElement(message) {
        const div = document.createElement('div');
        div.className = `message-item ${message.sender_id === window.chatConfig.userId ? 'sent' : 'received'}`;
        div.dataset.messageId = message.id;

        const isOwn = message.sender_id === window.chatConfig.userId;
        const deliveryStatus = this.getDeliveryStatusIcon(message.delivery_status);

        div.innerHTML = `
            <div class="message-bubble">
                ${message.reply_to_message ? this.renderReplyPreview(message.reply_to_message) : ''}
                <div class="message-content">${this.formatMessageContent(message.content)}</div>
                ${message.attachment ? this.renderAttachment(message.attachment) : ''}
                ${message.reactions && Object.keys(message.reactions).length > 0 ? this.renderReactions(message.reactions) : ''}
                <div class="message-meta">
                    <span class="message-time">${this.formatTime(message.created_at)}</span>
                    ${isOwn ? `<div class="message-status">${deliveryStatus}</div>` : ''}
                </div>
            </div>
        `;

        return div;
    }

    renderReplyPreview(replyMessage) {
        return `
            <div class="reply-preview-in-message">
                <div class="reply-sender">${replyMessage.sender.name}</div>
                <div class="reply-content">${this.formatMessageContent(replyMessage.content, true)}</div>
            </div>
        `;
    }

    renderAttachment(attachment) {
        const isImage = attachment.type && attachment.type.startsWith('image/');
        
        if (isImage) {
            return `
                <div class="message-attachment">
                    <img src="${attachment.url}" alt="${attachment.name}" class="attachment-image" loading="lazy">
                </div>
            `;
        } else {
            return `
                <div class="message-attachment">
                    <div class="attachment-file" data-url="${attachment.url}" data-name="${attachment.name}">
                        <i class="bi bi-file-earmark file-icon"></i>
                        <div class="file-info">
                            <div class="file-name">${attachment.name}</div>
                            <div class="file-size">${this.formatFileSize(attachment.size)}</div>
                        </div>
                        <i class="bi bi-download"></i>
                    </div>
                </div>
            `;
        }
    }

    renderReactions(reactions) {
        const reactionElements = Object.entries(reactions).map(([emoji, users]) => {
            const userReacted = users.some(user => user.id === window.chatConfig.userId);
            return `
                <div class="reaction-item ${userReacted ? 'user-reacted' : ''}" data-emoji="${emoji}">
                    <span class="reaction-emoji">${emoji}</span>
                    <span class="reaction-count">${users.length}</span>
                </div>
            `;
        }).join('');

        return `<div class="message-reactions">${reactionElements}</div>`;
    }

    async sendMessage() {
        const content = this.messageInput.value.trim();
        const fileInput = document.getElementById('fileInput');
        const replyToMessageId = document.getElementById('replyToMessageId').value;

        if (!content && !fileInput.files[0]) return;
        
        // Check if a conversation is selected
        if (!this.currentConversationId) {
            this.showError('Please select a conversation first');
            return;
        }

        const formData = new FormData();
        formData.append('conversation_id', this.currentConversationId);
        formData.append('content', content);
        
        if (fileInput.files[0]) {
            formData.append('attachment', fileInput.files[0]);
        }
        
        if (replyToMessageId) {
            formData.append('reply_to_message_id', replyToMessageId);
        }

        try {
            this.sendBtn.disabled = true;
            
            const response = await fetch(window.chatConfig.routes.sendMessage, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.chatConfig.csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);

            if (!response.ok) {
                const errorText = await response.text();
                console.error('Server response:', errorText);
                throw new Error(`Failed to send message: ${response.status} ${response.statusText}`);
            }

            const data = await response.json();
            
            // Clear form
            this.messageInput.value = '';
            fileInput.value = '';
            this.cancelReply();
            this.autoResizeTextarea();
            
            // Add message to UI (will also come through WebSocket)
            this.addMessageToUI(data.message);
            this.scrollToBottom();
            
        } catch (error) {
            console.error('Error sending message:', error);
            this.showError('Failed to send message');
        } finally {
            this.sendBtn.disabled = false;
        }
    }

    addMessageToUI(message) {
        const messageElement = this.createMessageElement(message);
        this.messageContainer.appendChild(messageElement);
        this.lastMessageId = message.id;
    }

    handleTyping() {
        if (!this.currentConversationId) return;

        // Clear existing timer
        if (this.typingTimer) {
            clearTimeout(this.typingTimer);
        }

        // Send typing start if not already typing
        if (!this.isTyping) {
            this.isTyping = true;
            this.sendTypingIndicator(true);
        }

        // Set timer to stop typing
        this.typingTimer = setTimeout(() => {
            this.isTyping = false;
            this.sendTypingIndicator(false);
        }, 2000);
    }

    async sendTypingIndicator(isTyping) {
        try {
            await fetch(window.chatConfig.routes.typing, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.chatConfig.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    conversation_id: this.currentConversationId,
                    is_typing: isTyping
                })
            });
        } catch (error) {
            console.error('Error sending typing indicator:', error);
        }
    }

    handleFileSelection(file) {
        if (!file) return;

        // Validate file size (10MB limit)
        if (file.size > 10 * 1024 * 1024) {
            this.showError('File size must be less than 10MB');
            return;
        }

        // Show file preview
        this.showFilePreview(file);
    }

    showFilePreview(file) {
        const preview = document.createElement('div');
        preview.className = 'file-preview';
        preview.innerHTML = `
            <div class="preview-content">
                <i class="bi bi-paperclip"></i>
                <span>${file.name}</span>
                <button type="button" class="btn-remove-file">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        `;

        preview.querySelector('.btn-remove-file').addEventListener('click', () => {
            preview.remove();
            document.getElementById('fileInput').value = '';
        });

        const inputContainer = document.querySelector('.message-input-container');
        const existingPreview = inputContainer.querySelector('.file-preview');
        if (existingPreview) {
            existingPreview.remove();
        }
        
        inputContainer.insertBefore(preview, inputContainer.firstChild);
    }

    async handleReactionClick(e) {
        const reactionItem = e.target.closest('.reaction-item');
        const messageElement = e.target.closest('.message-item');
        const messageId = messageElement.dataset.messageId;
        const emoji = reactionItem.dataset.emoji;
        const userReacted = reactionItem.classList.contains('user-reacted');

        try {
            const url = userReacted 
                ? window.chatConfig.routes.removeReaction.replace(':id', messageId)
                : window.chatConfig.routes.addReaction.replace(':id', messageId);

            const response = await fetch(url, {
                method: userReacted ? 'DELETE' : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.chatConfig.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ emoji })
            });

            if (!response.ok) throw new Error('Failed to update reaction');

            // Update UI will be handled by WebSocket
        } catch (error) {
            console.error('Error updating reaction:', error);
            this.showError('Failed to update reaction');
        }
    }

    handleMessageClick(e) {
        const messageElement = e.target.closest('.message-item');
        const messageId = messageElement.dataset.messageId;
        
        // Double-click to reply
        if (e.detail === 2) {
            this.replyToMessage(messageId);
        }
    }

    replyToMessage(messageId) {
        const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
        const messageContent = messageElement.querySelector('.message-content').textContent;
        const senderName = messageElement.classList.contains('sent') ? 'You' : document.getElementById('participantName').textContent;

        document.getElementById('replyToMessageId').value = messageId;
        document.getElementById('replyToSender').textContent = senderName;
        document.getElementById('replyToContent').textContent = messageContent;
        document.getElementById('replyPreview').style.display = 'block';

        this.messageInput.focus();
    }

    cancelReply() {
        document.getElementById('replyToMessageId').value = '';
        document.getElementById('replyPreview').style.display = 'none';
    }

    handleAttachmentClick(e) {
        const attachment = e.target.closest('.attachment-file, .attachment-image');
        const url = attachment.dataset.url || attachment.src;
        const name = attachment.dataset.name || 'attachment';

        if (attachment.classList.contains('attachment-image')) {
            this.showImagePreview(url, name);
        } else {
            this.downloadFile(url, name);
        }
    }

    showImagePreview(url, name) {
        const modal = document.getElementById('filePreviewModal');
        const title = document.getElementById('filePreviewTitle');
        const content = document.getElementById('filePreviewContent');
        const downloadBtn = document.getElementById('downloadFileBtn');

        title.textContent = name;
        content.innerHTML = `<img src="${url}" alt="${name}" style="max-width: 100%; height: auto;">`;
        downloadBtn.href = url;
        downloadBtn.download = name;

        new bootstrap.Modal(modal).show();
    }

    downloadFile(url, name) {
        const a = document.createElement('a');
        a.href = url;
        a.download = name;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    async showNewChatModal() {
        // Load admin users
        try {
            const response = await fetch('/api/admins', {
                headers: {
                    'X-CSRF-TOKEN': window.chatConfig.csrfToken,
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                const data = await response.json();
                const select = document.getElementById('adminSelect');
                select.innerHTML = '<option value="">Choose an admin...</option>';
                
                data.admins.forEach(admin => {
                    select.innerHTML += `<option value="${admin.id}">${admin.name}</option>`;
                });
            }
        } catch (error) {
            console.error('Error loading admins:', error);
        }

        new bootstrap.Modal(document.getElementById('newChatModal')).show();
    }

    async startNewChat() {
        const form = document.getElementById('newChatForm');
        const formData = new FormData(form);

        try {
            const response = await fetch(window.chatConfig.routes.startConversation, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.chatConfig.csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (!response.ok) throw new Error('Failed to start conversation');

            const data = await response.json();
            
            // Close modal
            bootstrap.Modal.getInstance(document.getElementById('newChatModal')).hide();
            
            // Reload conversations and select the new one
            await this.loadConversations();
            this.selectConversation(data.conversation.id);
            
        } catch (error) {
            console.error('Error starting conversation:', error);
            this.showError('Failed to start conversation');
        }
    }

    setupWebSocket() {
        // This would be implemented with Laravel Echo/Pusher
        // For now, we'll use polling as a fallback
        if (typeof Echo !== 'undefined') {
            this.setupEcho();
        } else {
            this.setupPolling();
        }
    }

    setupEcho() {
        // We'll set up Echo listeners when a conversation is selected
        this.echoChannels = new Map();
    }

    subscribeToConversation(conversationId) {
        if (this.echoChannels.has(conversationId)) {
            return; // Already subscribed
        }

        const channel = Echo.private(`conversation.${conversationId}`)
            .listen('MessageSent', (e) => {
                if (e.message.sender_id !== window.chatConfig.userId) {
                    this.addMessageToUI(e.message);
                    this.scrollToBottom();
                    this.updateConversationPreview(e.message);
                }
            })
            .listen('UserTyping', (e) => {
                if (e.user.id !== window.chatConfig.userId) {
                    this.showTypingIndicator(e.isTyping, e.user.name);
                }
            });

        this.echoChannels.set(conversationId, channel);
    }

    unsubscribeFromConversation(conversationId) {
        if (this.echoChannels.has(conversationId)) {
            Echo.leave(`conversation.${conversationId}`);
            this.echoChannels.delete(conversationId);
        }
    }

    updateConversationPreview(message) {
        const conversationElement = document.querySelector(`[data-conversation-id="${message.conversation_id}"]`);
        if (conversationElement) {
            const previewElement = conversationElement.querySelector('.conversation-preview');
            const timeElement = conversationElement.querySelector('.conversation-time');
            
            if (previewElement) {
                previewElement.textContent = this.formatMessagePreview(message);
            }
            if (timeElement) {
                timeElement.textContent = this.formatTime(message.created_at);
            }
            
            // Move conversation to top
            conversationElement.parentNode.insertBefore(conversationElement, conversationElement.parentNode.firstChild);
        }
    }

    setupPolling() {
        // Fallback polling every 5 seconds
        setInterval(() => {
            if (this.currentConversationId) {
                this.checkForNewMessages();
            }
        }, 5000);
    }

    async checkForNewMessages() {
        if (!this.lastMessageId) return;

        try {
            const response = await fetch(`/api/messages/since/${this.lastMessageId}?conversation_id=${this.currentConversationId}`, {
                headers: {
                    'X-CSRF-TOKEN': window.chatConfig.csrfToken,
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                const data = await response.json();
                data.messages.forEach(message => {
                    this.addMessageToUI(message);
                });
                
                if (data.messages.length > 0) {
                    this.scrollToBottom();
                }
            }
        } catch (error) {
            console.error('Error checking for new messages:', error);
        }
    }

    showTypingIndicator(isTyping, userName) {
        const indicator = document.getElementById('typingIndicator');
        const text = document.querySelector('.typing-text');
        
        if (isTyping) {
            text.textContent = `${userName} is typing...`;
            indicator.style.display = 'flex';
        } else {
            indicator.style.display = 'none';
        }
    }

    autoResizeTextarea() {
        const textarea = this.messageInput;
        textarea.style.height = 'auto';
        textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
    }

    scrollToBottom() {
        this.messageContainer.scrollTop = this.messageContainer.scrollHeight;
    }

    showError(message) {
        // You can implement a toast notification system here
        console.error(message);
        alert(message); // Temporary fallback
    }

    formatTime(timestamp) {
        const date = new Date(timestamp);
        const now = new Date();
        const diffInHours = (now - date) / (1000 * 60 * 60);

        if (diffInHours < 24) {
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        } else if (diffInHours < 168) { // 7 days
            return date.toLocaleDateString([], { weekday: 'short' });
        } else {
            return date.toLocaleDateString([], { month: 'short', day: 'numeric' });
        }
    }

    formatMessageContent(content, isPreview = false) {
        if (isPreview && content.length > 50) {
            content = content.substring(0, 50) + '...';
        }
        
        // Basic HTML escaping and link detection
        content = content.replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/'/g, '&#039;');
        
        // Convert URLs to links
        const urlRegex = /(https?:\/\/[^\s]+)/g;
        content = content.replace(urlRegex, '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>');
        
        // Convert line breaks
        content = content.replace(/\n/g, '<br>');
        
        return content;
    }

    formatMessagePreview(message) {
        if (message.attachment && !message.content) {
            return `📎 ${message.attachment.name}`;
        }
        return this.formatMessageContent(message.content, true);
    }

    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    getDeliveryStatusIcon(status) {
        switch (status) {
            case 'sent':
                return '<i class="bi bi-check status-icon status-delivered"></i>';
            case 'delivered':
                return '<i class="bi bi-check-all status-icon status-delivered"></i>';
            case 'read':
                return '<i class="bi bi-check-all status-icon status-read"></i>';
            default:
                return '<i class="bi bi-clock status-icon"></i>';
        }
    }
}

// Initialize chat when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    if (typeof window.chatConfig !== 'undefined') {
        window.chatApp = new ChatApp();
    }
});

// Add some CSS for file preview
const style = document.createElement('style');
style.textContent = `
    .file-preview {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
    }
    
    .preview-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .preview-content i {
        color: #007bff;
    }
    
    .preview-content span {
        flex: 1;
        font-size: 0.9rem;
    }
    
    .btn-remove-file {
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        padding: 2px;
    }
    
    .btn-remove-file:hover {
        color: #dc3545;
    }
    
    .reply-preview-in-message {
        background: rgba(0, 0, 0, 0.1);
        border-left: 3px solid currentColor;
        padding: 8px 12px;
        margin-bottom: 8px;
        border-radius: 4px;
        font-size: 0.85rem;
    }
    
    .reply-sender {
        font-weight: 600;
        margin-bottom: 2px;
        opacity: 0.9;
    }
    
    .reply-content {
        opacity: 0.8;
        font-style: italic;
    }
    
    .no-conversations {
        padding: 40px 20px;
        text-align: center;
        color: #6c757d;
    }
    
    .no-conversations p {
        margin-bottom: 10px;
    }
`;
document.head.appendChild(style);