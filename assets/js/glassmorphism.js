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

// Initialize DataTables
function initDataTable(tableId) {
    const table = document.querySelector(tableId);
    if (table && typeof jQuery !== 'undefined' && jQuery().DataTable) {
        jQuery(table).DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            autoWidth: false,
        });
    }
}

// Document Ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize dashboard datetime
    initDashboardDateTime();
    
    // Initialize captcha validation if form exists
    validateCaptcha('form');
    
    // Initialize DataTables
    initDataTable('#dataTable');
});
