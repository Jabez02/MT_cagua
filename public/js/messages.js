function updateFilters() {
    const search = document.getElementById('search').value;
    const status = document.getElementById('status-filter').value;
    const date = document.getElementById('date-filter').value;
    const sort = document.getElementById('sort-by').value;

    // Build the query string
    const params = new URLSearchParams(window.location.search);
    if (search) params.set('search', search);
    if (status) params.set('status', status);
    if (date) params.set('date', date);
    if (sort) params.set('sort', sort);

    // Redirect with the new filters
    window.location.href = `${window.location.pathname}?${params.toString()}`;
}

// Add event listeners to all filter inputs
document.addEventListener('DOMContentLoaded', function() {
    const filterInputs = [
        'search',
        'status-filter',
        'date-filter',
        'sort-by'
    ];

    filterInputs.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            if (element.tagName === 'SELECT') {
                element.addEventListener('change', updateFilters);
            } else {
                element.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        updateFilters();
                    }
                });
            }
        }
    });

    // Set initial values from URL params
    const params = new URLSearchParams(window.location.search);
    filterInputs.forEach(id => {
        const value = params.get(id.replace('-', ''));
        const element = document.getElementById(id);
        if (value && element) {
            element.value = value;
        }
    });
});