/* ================================================
   DATATABLES-INIT.JS - Reusable DataTable Configuration
   ================================================ */

/**
 * Initialize a standard DataTable with custom styling
 * Checks if already initialized to prevent reinitialization errors
 * @param {string} selector - jQuery selector for the table
 * @param {object} options - Additional DataTable options
 * @returns {object|null} DataTable instance or null if already initialized
 */
function initStandardDataTable(selector, options = {}) {
    // Check if DataTable is already initialized
    if ($.fn.DataTable.isDataTable(selector)) {
        console.log('DataTable already initialized for ' + selector + ', skipping');
        return $(selector).DataTable();
    }
    
    const defaultOptions = {
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search data...",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Showing 0 to 0 of 0 entries",
            infoFiltered: "(filtered from _MAX_ total entries)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            },
            emptyTable: "No data available in table",
            zeroRecords: "No matching records found"
        },
        dom: '<"dataTables_length"l>f<"dataTables_info"i>t<"dataTables_paginate"p>',
        initComplete: function(settings, json) {
            // Add custom styling after initialization
            $(selector + '_wrapper').addClass('dataTables-custom-wrapper');
        }
    };

    // Merge default options with custom options
    const mergedOptions = $.extend(true, {}, defaultOptions, options);

    return $(selector).DataTable(mergedOptions);
}

/**
 * Initialize DataTable with server-side processing
 * Checks if already initialized to prevent reinitialization errors
 * @param {string} selector - jQuery selector for the table
 * @param {string} ajaxUrl - URL for AJAX data source
 * @param {array} columns - Column definitions
 * @param {object} options - Additional DataTable options
 * @returns {object|null} DataTable instance or null if already initialized
 */
function initServerDataTable(selector, ajaxUrl, columns, options = {}) {
    // Check if DataTable is already initialized
    if ($.fn.DataTable.isDataTable(selector)) {
        console.log('DataTable already initialized for ' + selector + ', skipping');
        return $(selector).DataTable();
    }
    
    const defaultOptions = {
        processing: true,
        serverSide: true,
        ajax: {
            url: ajaxUrl,
            type: "POST",
            dataSrc: function(json) {
                return json.data || [];
            }
        },
        columns: columns,
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search data...",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Showing 0 to 0 of 0 entries",
            infoFiltered: "(filtered from _MAX_ total entries)",
            processing: '<div class="loading-spinner"></div> Processing...',
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            },
            emptyTable: "No data available in table",
            zeroRecords: "No matching records found"
        },
        dom: '<"dataTables_length"l>f<"dataTables_info"i>t<"dataTables_paginate"p>',
        initComplete: function(settings, json) {
            $(selector + '_wrapper').addClass('dataTables-custom-wrapper');
        }
    };

    const mergedOptions = $.extend(true, {}, defaultOptions, options);

    return $(selector).DataTable(mergedOptions);
}

/**
 * Destroy and reinitialize a DataTable
 * @param {string} selector - jQuery selector for the table
 */
function destroyDataTable(selector) {
    if ($.fn.DataTable.isDataTable(selector)) {
        $(selector).DataTable().destroy();
    }
}

/**
 * Reload DataTable data
 * @param {string} selector - jQuery selector for the table
 */
function reloadDataTable(selector) {
    if ($.fn.DataTable.isDataTable(selector)) {
        $(selector).DataTable().ajax.reload(null, false);
    }
}

/**
 * Get DataTable instance
 * @param {string} selector - jQuery selector for the table
 * @returns {object|null} DataTable instance or null
 */
function getDataTable(selector) {
    if ($.fn.DataTable.isDataTable(selector)) {
        return $(selector).DataTable();
    }
    return null;
}

/**
 * Search DataTable
 * @param {string} selector - jQuery selector for the table
 * @param {string} searchTerm - Search term
 */
function searchDataTable(selector, searchTerm) {
    const dt = getDataTable(selector);
    if (dt) {
        dt.search(searchTerm).draw();
    }
}

/**
 * Order DataTable by column
 * @param {string} selector - jQuery selector for the table
 * @param {number} columnIndex - Column index to order by
 * @param {string} direction - 'asc' or 'desc'
 */
function orderDataTable(selector, columnIndex, direction) {
    const dt = getDataTable(selector);
    if (dt) {
        dt.order([columnIndex, direction]).draw();
    }
}

/**
 * Change DataTable page length
 * @param {string} selector - jQuery selector for the table
 * @param {number} length - Number of rows per page
 */
function changePageLength(selector, length) {
    const dt = getDataTable(selector);
    if (dt) {
        dt.page.len(length).draw();
    }
}

// Auto-initialize standard DataTables when DOM is ready
// Only initializes tables with class 'dataTable-autoinit'
document.addEventListener("DOMContentLoaded", function() {
    // Initialize any tables with class 'dataTable-autoinit'
    $('.dataTable-autoinit').each(function() {
        const $table = $(this);
        const selector = '#' + this.id;
        
        // Skip if already initialized
        if (!$.fn.DataTable.isDataTable(selector)) {
            initStandardDataTable(selector);
        }
    });
});
