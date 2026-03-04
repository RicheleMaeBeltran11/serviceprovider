<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Service Provider</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Create Account</h2>
            <form id="registerForm">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="eMail" placeholder="rcm@gmail.com" required>
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobileNumber" placeholder="09XXXXXXXXX or 639XXXXXXXXX" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="passwd" placeholder="Enter your password" required>
                </div>
                <div id="message"></div>
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="login-page.php" class="link">Already have an account? Login</a>
            </form>
            
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
