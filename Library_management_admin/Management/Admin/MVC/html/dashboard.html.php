<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Library Management</title>
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/dashboard.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
            <a href="auth_logout.php" class="logout-btn">Logout</a>
        </div>
        
        <div class="content">
            <p class="welcome-msg">You have successfully logged in to the Admin Dashboard.</p>
            
            <div class="dashboard-grid">
                <a href="category_controller.php" class="card-link">
                    <h3>Manage Categories</h3>
                </a>
                <a href="book_controller.php" class="card-link">
                    <h3>Manage Books</h3>
                </a>
                <a href="request_controller.php" class="card-link">
                    <h3>Loan Requests</h3>
                </a>
                <a href="return_controller.php" class="card-link">
                    <h3>Track Returns</h3>
                </a>
                <a href="notice_controller.php" class="card-link">
                    <h3>Post Notices</h3>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
