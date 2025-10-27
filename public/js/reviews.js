document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const statusFilter = document.getElementById('status-filter');
    const sortBy = document.getElementById('sort-by');

    // Debounced search function
    let searchTimeout;
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                updateFilters();
            }, 500);
        });
    }

    // Update filters and URL parameters
    function updateFilters() {
        const searchQuery = searchInput ? searchInput.value.trim() : '';
        const status = statusFilter ? statusFilter.value : '';
        const sort = sortBy ? sortBy.value : '';

        const params = new URLSearchParams(window.location.search);
        
        if (searchQuery) {
            params.set('search', searchQuery);
        } else {
            params.delete('search');
        }

        if (status) {
            params.set('filter', status);
        } else {
            params.delete('filter');
        }

        if (sort) {
            params.set('sort', sort);
        } else {
            params.delete('sort');
        }

        window.location.href = `${window.location.pathname}?${params.toString()}`;
    }

    // Add event listeners for filters
    if (statusFilter) {
        statusFilter.addEventListener('change', updateFilters);
    }
    if (sortBy) {
        sortBy.addEventListener('change', updateFilters);
    }

    // Set initial values from URL params
    const urlParams = new URLSearchParams(window.location.search);
    if (searchInput) {
        searchInput.value = urlParams.get('search') || '';
    }
    if (statusFilter) {
        statusFilter.value = urlParams.get('filter') || '';
    }
    if (sortBy) {
        sortBy.value = urlParams.get('sort') || 'newest';
    }

    // Confirmation dialogs for destructive actions
    document.querySelectorAll('.review-action-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm(this.dataset.confirmMessage || 'Are you sure you want to delete this review? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });

    // Success message auto-hide
    const successAlert = document.querySelector('.bg-green-100');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity 0.3s ease-out';
            successAlert.style.opacity = '0';
            setTimeout(() => {
                successAlert.remove();
            }, 300);
        }, 3000);
    }
});