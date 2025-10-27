document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const statusFilter = document.getElementById('status-filter');
    const sortBy = document.getElementById('sort-by');
    let searchTimeout;

    // Function to update URL parameters and reload page
    function updateFilters() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // Update search parameter
        if (searchInput.value) {
            urlParams.set('search', searchInput.value);
        } else {
            urlParams.delete('search');
        }

        // Update status parameter
        if (statusFilter.value) {
            urlParams.set('status', statusFilter.value);
        } else {
            urlParams.delete('status');
        }

        // Update sort parameter
        if (sortBy.value) {
            urlParams.set('sort', sortBy.value);
        } else {
            urlParams.delete('sort');
        }

        // Reload page with new parameters
        window.location.href = `${window.location.pathname}?${urlParams.toString()}`;
    }

    // Set initial values from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    searchInput.value = urlParams.get('search') || '';
    statusFilter.value = urlParams.get('status') || '';
    sortBy.value = urlParams.get('sort') || 'newest';

    // Add event listeners
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(updateFilters, 500);
    });

    statusFilter.addEventListener('change', updateFilters);
    sortBy.addEventListener('change', updateFilters);

    // Auto-hide success messages after 5 seconds
    const successAlert = document.querySelector('.bg-green-100');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity 1s ease-out';
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 1000);
        }, 5000);
    }
});