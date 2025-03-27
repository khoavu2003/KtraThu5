<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .login-container { width: 300px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background: #f9f9f9; }
        input { width: 90%; padding: 8px; margin: 10px 0; }
        button { background: #007bff; color: white; padding: 10px; border: none; width: 100%; }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Đăng nhập</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="/Ktra/login" method="POST">
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng nhập</button>
        </form>
    </div>

</body>
</html>
