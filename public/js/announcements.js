function updateFilters() {
    const type = document.getElementById('type').value;
    const status = document.getElementById('status').value;
    const params = new URLSearchParams(window.location.search);
    
    if (type) {
        params.set('type', type);
    } else {
        params.delete('type');
    }
    
    if (status) {
        params.set('status', status);
    } else {
        params.delete('status');
    }
    
    window.location.href = `${window.location.pathname}?${params.toString()}`;
}

// Initialize filters on page load
document.addEventListener('DOMContentLoaded', function() {
    const params = new URLSearchParams(window.location.search);
    const type = params.get('type');
    const status = params.get('status');

    if (type) {
        document.getElementById('type').value = type;
    }
    if (status) {
        document.getElementById('status').value = status;
    }
});