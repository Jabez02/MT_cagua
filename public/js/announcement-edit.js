// Initialize character counters
document.addEventListener('DOMContentLoaded', function() {
    updateCharacterCount('title');
    updateCharacterCount('content');
    updatePreview();
});

function updateCharacterCount(fieldId) {
    const field = document.getElementById(fieldId);
    const counter = document.getElementById(fieldId + 'Count');
    counter.textContent = field.value.length;
}

function togglePreview() {
    const previewPanel = document.getElementById('previewPanel');
    const previewButtonText = document.getElementById('previewButtonText');
    const isHidden = previewPanel.classList.contains('hidden');
    
    if (isHidden) {
        previewPanel.classList.remove('hidden');
        previewButtonText.textContent = 'Hide Preview';
    } else {
        previewPanel.classList.add('hidden');
        previewButtonText.textContent = 'Preview';
    }
}

function updatePreview() {
    // Update character counts
    updateCharacterCount('title');
    updateCharacterCount('content');

    // Update preview content
    document.getElementById('previewTitle').textContent = document.getElementById('title').value || 'Title';
    document.getElementById('previewContent').textContent = document.getElementById('content').value || 'Content';

    // Update type badge
    const type = document.getElementById('type').value;
    const previewType = document.getElementById('previewType');
    previewType.textContent = type.charAt(0).toUpperCase() + type.slice(1);
    previewType.className = 'px-2 py-1 text-xs font-semibold rounded-full ' + 
        (type === 'emergency' ? 'bg-red-100 text-red-800' : 
        (type === 'weather' ? 'bg-blue-100 text-blue-800' : 
        (type === 'trail' ? 'bg-green-100 text-green-800' : 
        'bg-gray-100 text-gray-800')));

    // Update expiry
    const expiryDate = document.getElementById('expires_at').value;
    document.getElementById('previewExpiry').textContent = expiryDate ? 
        'Expires: ' + new Date(expiryDate).toLocaleString() : 
        'No expiration';
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('announcementForm').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const content = document.getElementById('content').value.trim();
        const type = document.getElementById('type').value;
        let isValid = true;
        let errors = [];

        if (title.length < 5) {
            errors.push('Title must be at least 5 characters long');
            isValid = false;
        }

        if (content.length < 10) {
            errors.push('Content must be at least 10 characters long');
            isValid = false;
        }

        if (type === 'emergency') {
            const confirmEmergency = confirm('You are about to post an emergency announcement. This will be highlighted to all users. Continue?');
            if (!confirmEmergency) {
                e.preventDefault();
                return;
            }
        }

        if (!isValid) {
            e.preventDefault();
            alert(errors.join('\n'));
        }
    });
});