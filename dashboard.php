<?php
session_start();
if(!isset($_SESSION['userId'])){
    header("Location: login-page.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Service Provider</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Dashboard</h2>
            <div class="dashboard-content">
                <p>Welcome! You are logged in successfully.</p>
                <p><strong>User ID:</strong> <?php echo htmlspecialchars($_SESSION['userId']); ?></p>
                <div class="button-group">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
