<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Service Provider</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Login</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label>Email or Mobile Number</label>
                    <input type="text" name="eMail" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="passwd" required>
                </div>
                <div id="message"></div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="forgot-password.php" class="link">Forgot Password?</a>
                <a href="register.php" class="link">Don't have an account? Register</a>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
