<?php
// Management/Admin/MVC/php/auth_login.php
require_once __DIR__ . '/middleware.php';
require_once __DIR__ . '/../db/db.php';

requireGuest();


$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, trim($_POST['username'] ?? ''));
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username' AND role = 'admin'";
        $result = mysqli_query($conn, $sql);
        $admin = mysqli_fetch_assoc($result);

        if 
        ($admin && password_verify($password, $admin['password'])) {
            // Login Success
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            
            // Handle Remember Me
            if 
            (isset($_POST['remember'])) {
                // Simple secure token strategy: username + hashed signature
                // Ideally use a database token, but falling back to stateless signature for now as per plan
                $secret_key = "SuperSecretKey_ChangeThisInProduction"; 
                $token_payload = $admin['username'];
                $signature = hash_hmac('sha256', $token_payload, $secret_key);
                $cookie_value = base64_encode($token_payload . ':' . $signature);
                
                // Set cookie for 30 days
                setcookie('admin_remember', $cookie_value, time() + (86400 * 30), "/");
            }

            header("Location: dashboard_controller.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}

// Load View
include __DIR__ . '/../html/login.html.php';
?>
