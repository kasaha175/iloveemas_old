/**
 * Glassmorphism - Common JavaScript Functions
 * ILoveEmas Application
 */

// Dashboard Date/Time Update
function updateDateTime() {
    const now = new Date();
    
    // Format tanggal Indonesia
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateStr = now.toLocaleDateString('id-ID', options);
    
    // Format waktu
    const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    
    // Update elements if they exist
    const dateElement = document.getElementById('currentDate');
    const timeElement = document.getElementById('currentTime');
    
    if (dateElement) {
        dateElement.textContent = dateStr;
    }
    
    if (timeElement) {
        timeElement.textContent = timeStr;
    }
}

// Initialize dashboard date/time
function initDashboardDateTime() {
    updateDateTime();
    setInterval(updateDateTime, 1000);
}

// Captcha Functions
function refreshCaptcha() {
    const num1El = document.getElementById('num1');
    const num2El = document.getElementById('num2');
    const resultEl = document.getElementById('captcha-result');
    const inputEl = document.getElementById('captcha-input');
    
    if (num1El && num2El && resultEl) {
        var num1 = Math.floor(Math.random() * 10) + 1;
        var num2 = Math.floor(Math.random() * 10) + 1;
        var result = num1 + num2;
        
        num1El.textContent = num1;
        num2El.textContent = num2;
        resultEl.value = result;
        
        if (inputEl) {
            inputEl.value = '';
        }
    }
}

// Validate Captcha on Form Submit
function validateCaptcha(formSelector) {
    const form = document.querySelector(formSelector);
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const userAnswer = parseInt(document.getElementById('captcha-input').value);
            const correctAnswer = parseInt(document.getElementById('captcha-result').value);
            
            if (isNaN(userAnswer) || userAnswer !== correctAnswer) {
                e.preventDefault();
                alert('Jawaban captcha salah! Silakan coba lagi.');
                refreshCaptcha();
            }
        });
    }
}

// Initialize DataTables with reinitialization check
// This function can be called manually by views that need DataTables
// Usage: initDataTable('#dataTable', { /* custom options */ });
function initDataTable(tableId, options) {
    const table = document.querySelector(tableId);
    if (table && typeof jQuery !== 'undefined' && jQuery().DataTable) {
        // Check if DataTable is already initialized to prevent reinitialization error
        if (!jQuery.fn.DataTable.isDataTable(tableId)) {
            const defaultOptions = {
                paging: true,
                searching: true,
                lengthChange: true,
                autoWidth: false,
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
            const mergedOptions = { ...defaultOptions, ...options };
            
            jQuery(table).DataTable(mergedOptions);
            console.log('DataTable initialized for ' + tableId);
        } else {
            console.log('DataTable already initialized for ' + tableId + ', skipping');
        }
    }
}

// Document Ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize dashboard datetime
    initDashboardDateTime();
    
    // Initialize captcha validation if form exists
    validateCaptcha('form');
    
    // Note: DataTable initialization is now handled by each view individually
    // to avoid reinitialization errors. Use initDataTable('#dataTable') in views.
});
