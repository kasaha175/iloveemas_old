<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=$title?></title>
<link rel="icon" type="image/x-icon" href="<?=base_url()?>favicon.ico">

<link rel="stylesheet" href="<?=base_url()?>assets/css/login.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>

<div class="login-wrapper">

    <div class="login-left">
        <div class="left-content">
            <h1>ILoveEmas</h1>
            <p>Kelola emas Anda dengan mudah dan aman</p>
        </div>
    </div>

    <div class="login-right">
        
        <div class="login-header">
            <div class="logo">
                <img src="<?=base_url()?>assets/img/logo-new.webp" alt="Logo">
            </div>
            <h2>Selamat Datang</h2>
            <p>Masukkan username dan password Anda</p>
        </div>

        <form action="<?=base_url()?>login-process" method="post" id="loginForm">
            
            <div class="form-label-group">
                <input type="text" name="username" id="username" placeholder=" " required autofocus autocomplete="off">
                <label for="username">Username</label>
            </div>

            <div class="form-label-group">
                <input type="password" name="password" id="password" placeholder=" " required autocomplete="off">
                <label for="password">Password</label>
            </div>

            <!-- Captcha Section -->
            <?php 
                $num1 = rand(1, 10);
                $num2 = rand(1, 10);
                $result = $num1 + $num2;
            ?>
            <div class="captcha-section">
                <div class="captcha-box">
                    <span class="captcha-num" id="num1"><?php echo $num1; ?></span>
                    <span class="captcha-operator">+</span>
                    <span class="captcha-num" id="num2"><?php echo $num2; ?></span>
                    <span class="captcha-operator">=</span>
                    <input type="number" id="captcha-input" placeholder="?" min="1" max="20" required>
                    <input type="hidden" id="captcha-result" value="<?php echo $result; ?>">
                    <button type="button" class="btn-refresh" onclick="refreshCaptcha()" title="Refresh Captcha">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/></svg>
                    </button>
                </div>
                <p class="captcha-hint">Isikan hasil penjumlahan di atas</p>
            </div>

            <button type="submit" class="btn-login" id="loginBtn">
                <span class="btn-text">Masuk</span>
                <span class="btn-loader">
                    <span class="spinner"></span>
                </span>
            </button>

            <div class="login-toast" id="loginToast"></div>

        </form>

        <?php if($this->session->userdata("failedLogin")==true){ ?>
        <div class="error-msg">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
            <span><?php echo $this->session->userdata("lockout_message") ?: "Username atau password salah!"; ?></span>
        </div>
        <?php 
            $this->session->set_userdata(['failedLogin'=>false, 'lockout_message'=>null]);
        } ?>

        <!-- Version -->
        <div class="app-version">
            ILoveEmas v3.0.0
        </div>

    </div>

</div>

<script>
function refreshCaptcha() {
    var num1 = Math.floor(Math.random() * 10) + 1;
    var num2 = Math.floor(Math.random() * 10) + 1;
    var result = num1 + num2;
    
    document.getElementById('num1').textContent = num1;
    document.getElementById('num2').textContent = num2;
    document.getElementById('captcha-result').value = result;
    document.getElementById('captcha-input').value = '';
}

document.querySelector('form').addEventListener('submit', function(e) {
    var userAnswer = parseInt(document.getElementById('captcha-input').value);
    var correctAnswer = parseInt(document.getElementById('captcha-result').value);
    
    if (userAnswer !== correctAnswer) {
        e.preventDefault();
        alert('Jawaban captcha salah! Silakan coba lagi.');
        refreshCaptcha();
        return false;
    }
    
    // Show loading state
    var btn = document.getElementById('loginBtn');
    btn.classList.add('loading');
    btn.disabled = true;
});
</script>

</body>
</html>
