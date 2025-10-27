// Function to update unread messages count
function updateUnreadCount() {
    // Determine the correct endpoint based on user type
    const isAdmin = document.querySelector('.admin-navigation') !== null;
    const endpoint = isAdmin ? '/admin/messages/unread-count' : '/messages/unread-count';
    
    fetch(endpoint, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        credentials: 'same-origin'
    })
        .then(response => {
            // Check if response is ok and content-type is JSON
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                // If we get HTML instead of JSON, user is likely not authenticated
                console.warn('Received non-JSON response, user may not be authenticated');
                return null;
            }
            
            return response.json();
        })
        .then(data => {
            // If data is null (authentication issue), skip updating
            if (!data) {
                return;
            }
            
            const count = data.count;
            
            // Update admin navigation badge
            const countElement = document.getElementById('unread-messages-count');
            const countElementMobile = document.getElementById('unread-messages-count-mobile');
            
            // Update user navigation badge
            const userCountElement = document.getElementById('user-unread-messages-count');
            
            if (countElement) {
                if (count > 0) {
                    countElement.textContent = count;
                    countElement.classList.remove('d-none');
                } else {
                    countElement.classList.add('d-none');
                }
            }

            if (countElementMobile) {
                if (count > 0) {
                    countElementMobile.textContent = count;
                    countElementMobile.classList.remove('d-none');
                } else {
                    countElementMobile.classList.add('d-none');
                }
            }
            
            if (userCountElement) {
                if (count > 0) {
                    userCountElement.textContent = count;
                    userCountElement.classList.remove('d-none');
                } else {
                    userCountElement.classList.add('d-none');
                }
            }
        })
        .catch(error => {
            // Only log actual errors, not authentication redirects
            if (error.message.includes('Unexpected token')) {
                console.warn('Authentication required for unread count endpoint');
            } else {
                console.error('Error fetching unread count:', error);
            }
        });
}

// Initial update
document.addEventListener('DOMContentLoaded', () => {
    updateUnreadCount();
    // Update every minute
    setInterval(updateUnreadCount, 60000);
});