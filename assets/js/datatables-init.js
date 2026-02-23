/* ================================================
   DATATABLES-INIT.JS - Centralized DataTable Configuration
   ================================================
   
   IMPORTANT: This is the ONLY file that should initialize DataTables.
   All other JS files should NOT call DataTable initialization.
   
   Usage in views:
   <script>
       $(document).ready(function() {
           initDataTable('#dataTable');
       });
   </script>
   
   Or with custom options:
   <script>
       $(document).ready(function() {
           initDataTable('#dataTable', {
               pageLength: 25,
               order: [[0, 'desc']]
           });
       });
   </script>
*/

/**
 * Initialize a DataTable with safe reinitialization check
 * This is the SINGLE point of DataTable initialization
 * @param {string} selector - jQuery selector for the table
 * @param {object} options - Additional DataTable options
 * @returns {object|null} DataTable instance or null if already initialized
 */
function initDataTable(selector, options = {}) {
    // Check if DataTable is already initialized to prevent reinitialization error
    if ($(selector).length === 0) {
        console.warn('Table not found for selector: ' + selector);
        return null;
    }
    
    if ($.fn.DataTable.isDataTable(selector)) {
        console.log('DataTable already initialized for ' + selector + ', destroying and reinitializing...');
        $(selector).DataTable().destroy();
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
        }
    };

    // Merge default options with custom options
    const mergedOptions = $.extend(true, {}, defaultOptions, options);

    return $(selector).DataTable(mergedOptions);
}

/**
 * Initialize DataTable with server-side processing
 * @param {string} selector - jQuery selector for the table
 * @param {string} ajaxUrl - URL for AJAX data source
 * @param {array} columns - Column definitions
 * @param {object} options - Additional DataTable options
 * @returns {object|null} DataTable instance or null
 */
function initServerDataTable(selector, ajaxUrl, columns, options = {}) {
    if ($(selector).length === 0) {
        console.warn('Table not found for selector: ' + selector);
        return null;
    }
    
    if ($.fn.DataTable.isDataTable(selector)) {
        console.log('DataTable already initialized for ' + selector + ', destroying and reinitializing...');
        $(selector).DataTable().destroy();
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
        }
    };

    const mergedOptions = $.extend(true, {}, defaultOptions, options);

    return $(selector).DataTable(mergedOptions);
}

/**
 * Destroy a DataTable instance
 * @param {string} selector - jQuery selector for the table
 */
function destroyDataTable(selector) {
    if ($.fn.DataTable.isDataTable(selector)) {
        $(selector).DataTable().destroy();
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
 * Reload DataTable data (for AJAX DataTables)
 * @param {string} selector - jQuery selector for the table
 */
function reloadDataTable(selector) {
    const dt = getDataTable(selector);
    if (dt && dt.ajax) {
        dt.ajax.reload(null, false);
    }
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
