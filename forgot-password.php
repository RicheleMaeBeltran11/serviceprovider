<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Service Provider</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Reset Password</h2>
            
            <!-- Step 1: Send OTP -->
            <div id="step1">
                <form id="sendOtpForm">
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobileNumber" id="mobileNumber" placeholder="09XXXXXXXXX or 639XXXXXXXXX" required>
                    </div>
                    <div id="message1"></div>
                    <button type="submit" class="btn btn-primary">Send OTP</button>
                    <a href="login-page.php" class="link">Back to Login</a>
                </form>
            </div>

            <!-- Step 2: Verify OTP -->
            <div id="step2" style="display:none;">
                <form id="verifyOtpForm">
                    <div class="form-group">
                        <label>Enter OTP</label>
                        <input type="text" name="otpNumber" id="otpNumber" required>
                    </div>
                    <div id="message2"></div>
                    <button type="submit" class="btn btn-primary">Verify OTP</button>
                </form>
            </div>

            <!-- Step 3: Change Password -->
            <div id="step3" style="display:none;">
                <form id="changePasswordForm">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmPassword" required>
                    </div>
                    <div id="message3"></div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
