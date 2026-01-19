<?php
// Management/Admin/MVC/db/seed_admin.php
require_once 'db.php';

echo "Connected to: " . $dbname . "\n";
$username = 'admin';
$password = 'admin123'; // Default password
$email = 'admin@library.com';
$role = 'admin';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Escape inputs safely
$username_safe = mysqli_real_escape_string($conn, $username);
$email_safe = mysqli_real_escape_string($conn, $email);
$role_safe = mysqli_real_escape_string($conn, $role);

// Check if admin exists
$checkSql = "SELECT id FROM users WHERE username = '$username_safe'";
$result = mysqli_query($conn, $checkSql);

if (mysqli_num_rows($result) > 0) {
    echo "Admin user already exists.\n";
} else {
    $insertSql = "INSERT INTO users (username, password, email, role) VALUES ('$username_safe', '$hashed_password', '$email_safe', '$role_safe')";
    
    if (mysqli_query($conn, $insertSql)) {
        echo "Admin user created successfully.\n";
        echo "Username: $username\n";
        echo "Password: $password\n";
    } else {
        echo "Error creating admin user: " . mysqli_error($conn) . "\n";
    }
}


mysqli_close($conn);
?>
