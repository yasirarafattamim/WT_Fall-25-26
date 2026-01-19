<?php
// Management/Admin/MVC/php/auth_logout.php
require_once __DIR__ . '/middleware.php';

// Clear Session
session_unset();
session_destroy();

// Clear Remember Me Cookie
if (isset($_COOKIE['admin_remember'])) {
    setcookie('admin_remember', '', time() - 3600, '/');
}


header("Location: auth_login.php");
exit();
?>
