<?php
// Management/Admin/MVC/php/dashboard_controller.php
require_once __DIR__ . '/middleware.php';

requireAuth();

$username = $_SESSION['admin_username'] ?? 'Admin';

include __DIR__ . '/../html/dashboard.html.php';
?>
