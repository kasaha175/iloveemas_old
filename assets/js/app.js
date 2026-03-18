/* ================================================
   APP.JS - Base Application Initialization
   ================================================ */

// Global base URL - will be set dynamically
var baseUrl = '';

// Wait for DOM to be ready
document.addEventListener("DOMContentLoaded", function() {
    console.log("App initialized");
    
    // Initialize any global functionality here
    initializeApp();
});

/**
 * Initialize global application functionality
 */
function initializeApp() {
    // Add any global initialization code here
    
    // Initialize tooltips if using any
    initTooltips();
    
    // Initialize navbar clock
    if (typeof initNavbarClock === 'function') {
        initNavbarClock();
    }
    
    // Initialize any third-party plugins
    initPlugins();
}

/**
 * Initialize tooltips
 */
function initTooltips() {
    // Tooltip functionality if needed
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    
    tooltipElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            const tooltip = this.getAttribute('data-tooltip');
            if (tooltip) {
                // Tooltip is handled by CSS
            }
        });
    });
}

/**
 * Initialize third-party plugins
 */
function initPlugins() {
    // Initialize any plugins that need global setup
}

/**
 * Show loading indicator
 */
function showLoading() {
    Swal.fire({
        title: 'Loading...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        },
        customClass: {
            popup: 'glass-swal-popup'
        }
    });
}

/**
 * Hide loading indicator
 */
function hideLoading() {
    Swal.close();
}

/**
 * Show success message
 * @param {string} message - Message to display
 * @param {function} callback - Optional callback after confirmation
 */
function showSuccess(message, callback) {
    Swal.fire({
        title: 'Success!',
        text: message,
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#28a745',
        customClass: {
            popup: 'glass-swal-popup'
        }
    }).then((result) => {
        if (callback && typeof callback === 'function') {
            callback(result);
        }
    });
}

/**
 * Show error message
 * @param {string} message - Message to display
 * @param {function} callback - Optional callback after confirmation
 */
function showError(message, callback) {
    Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error',
        confirmButtonText: 'OK',
        confirmButtonColor: '#dc3545',
        customClass: {
            popup: 'glass-swal-popup'
        }
    }).then((result) => {
        if (callback && typeof callback === 'function') {
            callback(result);
        }
    });
}

/**
 * Show confirmation dialog
 * @param {string} title - Dialog title
 * @param {string} message - Dialog message
 * @param {function} onConfirm - Callback on confirm
 * @param {function} onCancel - Optional callback on cancel
 */
function showConfirm(title, message, onConfirm, onCancel) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, proceed!',
        cancelButtonText: 'Cancel',
        customClass: {
            popup: 'glass-swal-popup'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            if (onConfirm && typeof onConfirm === 'function') {
                onConfirm(result);
            }
        } else if (result.isDismissed && onCancel && typeof onCancel === 'function') {
            onCancel(result);
        }
    });
}

/**
 * Format currency to Indonesian Rupiah
 * @param {number} amount - Amount to format
 * @returns {string} Formatted currency string
 */
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

/**
 * Format date to Indonesian locale
 * @param {string|Date} date - Date to format
 * @returns {string} Formatted date string
 */
function formatDate(date) {
    const d = new Date(date);
    return new Intl.DateTimeFormat('id-ID', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    }).format(d);
}

/**
 * Format datetime to Indonesian locale
 * @param {string|Date} date - Date to format
 * @returns {string} Formatted datetime string
 */
function formatDateTime(date) {
    const d = new Date(date);
    return new Intl.DateTimeFormat('id-ID', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    }).format(d);
}

/**
 * Indonesian Month Names
 */
const bulanNames = [
    'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
    'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
];

/**
 * Update Navbar Date & Time - Real-time Clock
 */
function updateNavbarDateTime() {
    const now = new Date();
    
    // Format tanggal Indonesia: "20 Mar 2026"
    const hari = now.getDate();
    const bulanIdx = now.getMonth();
    const tahun = now.getFullYear();
    const tanggalText = `${hari} ${bulanNames[bulanIdx]} ${tahun}`;
    
    // Format jam: "14:35:22"
    const jam = now.getHours().toString().padStart(2, '0');
    const menit = now.getMinutes().toString().padStart(2, '0');
    const detik = now.getSeconds().toString().padStart(2, '0');
    const jamText = `${jam}:${menit}:${detik}`;
    
    // Update elements
    const dateEl = document.getElementById('currentDate');
    const timeEl = document.getElementById('currentTime');
    
    if (dateEl) dateEl.textContent = tanggalText;
    if (timeEl) timeEl.textContent = jamText;
}

/**
 * Initialize Navbar Clock - Auto-start
 */
function initNavbarClock() {
    // Update immediately
    updateNavbarDateTime();
    
    // Update every second
    setInterval(updateNavbarDateTime, 1000);
}

// Export for global use if needed
window.updateNavbarDateTime = updateNavbarDateTime;
window.initNavbarClock = initNavbarClock;

