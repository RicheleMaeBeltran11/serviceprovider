// Register Form
const registerForm = document.getElementById('registerForm');
if(registerForm) {
    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(registerForm);
        const messageDiv = document.getElementById('message');
        
        try {
            const response = await fetch('createUser.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            
            messageDiv.textContent = data.message;
            messageDiv.className = data.status === 'success' ? 'success' : 'error';
            
            if(data.status === 'success') {
                setTimeout(() => {
                    window.location.href = 'login-page.php';
                }, 2000);
            }
        } catch(error) {
            messageDiv.textContent = 'An error occurred';
            messageDiv.className = 'error';
        }
    });
}

// Login Form
const loginForm = document.getElementById('loginForm');
if(loginForm) {
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(loginForm);
        const messageDiv = document.getElementById('message');
        
        try {
            const response = await fetch('login.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            
            messageDiv.textContent = data.message;
            messageDiv.className = data.status === 'success' ? 'success' : 'error';
            
            if(data.status === 'success') {
                // Create session via PHP
                await fetch('create-session.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({userId: data.userId})
                });
                
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 1000);
            }
        } catch(error) {
            messageDiv.textContent = 'An error occurred';
            messageDiv.className = 'error';
        }
    });
}

// Send OTP Form
const sendOtpForm = document.getElementById('sendOtpForm');
if(sendOtpForm) {
    sendOtpForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(sendOtpForm);
        const messageDiv = document.getElementById('message1');
        
        try {
            const response = await fetch('sendOtp.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            
            messageDiv.textContent = data.message;
            messageDiv.className = data.status === 'success' ? 'success' : 'error';
            
            if(data.status === 'success') {
                setTimeout(() => {
                    document.getElementById('step1').style.display = 'none';
                    document.getElementById('step2').style.display = 'block';
                }, 1500);
            }
        } catch(error) {
            messageDiv.textContent = 'An error occurred';
            messageDiv.className = 'error';
        }
    });
}

// Verify OTP Form
const verifyOtpForm = document.getElementById('verifyOtpForm');
if(verifyOtpForm) {
    verifyOtpForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const mobileNumber = document.getElementById('mobileNumber').value;
        const otpNumber = document.getElementById('otpNumber').value;
        const messageDiv = document.getElementById('message2');
        
        const formData = new FormData();
        formData.append('mobileNumber', mobileNumber);
        formData.append('otpNumber', otpNumber);
        
        try {
            const response = await fetch('verifyOtp.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            
            messageDiv.textContent = data.message;
            messageDiv.className = data.status === 'success' ? 'success' : 'error';
            
            if(data.status === 'success') {
                setTimeout(() => {
                    document.getElementById('step2').style.display = 'none';
                    document.getElementById('step3').style.display = 'block';
                }, 1500);
            }
        } catch(error) {
            messageDiv.textContent = 'An error occurred';
            messageDiv.className = 'error';
        }
    });
}

// Change Password Form
const changePasswordForm = document.getElementById('changePasswordForm');
if(changePasswordForm) {
    changePasswordForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const newPassword = e.target.newPassword.value;
        const confirmPassword = e.target.confirmPassword.value;
        const messageDiv = document.getElementById('message3');
        
        if(newPassword !== confirmPassword) {
            messageDiv.textContent = 'Passwords do not match';
            messageDiv.className = 'error';
            return;
        }
        
        const mobileNumber = document.getElementById('mobileNumber').value;
        const otpNumber = document.getElementById('otpNumber').value;
        
        const formData = new FormData();
        formData.append('mobileNumber', mobileNumber);
        formData.append('otpNumber', otpNumber);
        formData.append('newPassword', newPassword);
        
        try {
            const response = await fetch('changePassword.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            
            messageDiv.textContent = data.message;
            messageDiv.className = data.status === 'success' ? 'success' : 'error';
            
            if(data.status === 'success') {
                setTimeout(() => {
                    window.location.href = 'login-page.php';
                }, 2000);
            }
        } catch(error) {
            messageDiv.textContent = 'An error occurred';
            messageDiv.className = 'error';
        }
    });
}
