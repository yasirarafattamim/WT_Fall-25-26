<?php
// Management/Admin/MVC/php/middleware.php
session_start();

function isLoggedIn() {
    if (isset($_SESSION['admin_id'])) {
        return true;
    }

    // Check for Remember Me Cookie
    if (isset($_COOKIE['admin_remember'])) {
        require_once __DIR__ . '/../db/db.php';
        global $conn;

        $cookie_val = base64_decode($_COOKIE['admin_remember']);
        $parts = explode(':', $cookie_val);
        
        if (count($parts) === 2) {
            $username = $parts[0];
            $signature = $parts[1];
            $secret_key = "SuperSecretKey_ChangeThisInProduction";

            // Verify Signature
            $expected_signature = hash_hmac('sha256', $username, $secret_key);
            
            if (hash_equals($expected_signature, $signature)) {
                // Verify User exists in DB
                $username_safe = mysqli_real_escape_string($conn, $username);
                $sql = "SELECT * FROM users WHERE username = '$username_safe' AND role = 'admin'";
                $result = mysqli_query($conn, $sql);
                $admin = mysqli_fetch_assoc($result);

                if ($admin) {
                    // Restore Session
                    session_regenerate_id(true);
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['admin_username'] = $admin['username'];
                    return true;
                }
            }
        }
    }

    return false;
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: ../php/auth_login.php");
        exit();
    }
}

function requireAuth() {
    requireLogin();
}

function requireGuest() {
    if (isLoggedIn()) {
        header("Location: ../php/dashboard_controller.php");
        exit();
    }
}
?>
