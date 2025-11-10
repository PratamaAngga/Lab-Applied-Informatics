<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Applied Informatics Laboratory</title>
    <!-- Menghubungkan ke file CSS khusus login -->
    <link rel="stylesheet" type="text/css" href="css/login-style.css">
    <!-- Font Awesome untuk ikon mata pada password (opsional, tapi bagus untuk UX) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <div class="logo-container">
                <!-- GANTI src dengan path logo Anda yang benar -->
                <img src="img/logolabai.png" alt="Applied Informatics Logo" class="login-logo">
            </div>

            <form action="proses-login.php" method="POST" class="login-form">
                <div class="input-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap anda" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="Masukkan password anda" required>
                        <i class="fa-regular fa-eye-slash toggle-password" id="togglePassword"></i>
                    </div>
                </div>

                <button type="submit" class="btn-login-submit">LOGIN</button>
            </form>
        </div>
    </div>

    <!-- Script sederhana untuk toggle password visibility -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>