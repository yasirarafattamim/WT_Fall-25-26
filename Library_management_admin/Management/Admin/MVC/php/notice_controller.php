<?php
// Management/Admin/MVC/php/notice_controller.php
require_once __DIR__ . '/middleware.php';
require_once __DIR__ . '/../db/db.php';

requireAuth();

$message = '';
$error = '';

// Handle Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $title = mysqli_real_escape_string($conn, trim($_POST['title'] ?? ''));
            $content = mysqli_real_escape_string($conn, trim($_POST['content'] ?? ''));
            
            if (!empty($title) && !empty($content)) {
                $sql = "INSERT INTO notices (title, content) VALUES ('$title', '$content')";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['message'] = "Notice posted successfully.";
                } else {
                    $_SESSION['error'] = "Failed to post notice.";
                }
            } else {
                $_SESSION['error'] = "Title and content cannot be empty.";
            }
        } elseif ($_POST['action'] === 'delete') {
            $id = (int)$_POST['id'];
            $sql = "DELETE FROM notices WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "Notice deleted successfully.";
            } else {
                $_SESSION['error'] = "Failed to delete notice.";
            }
        }
    }
    header("Location: notice_controller.php");
    exit();
}


// Check for Session Messages
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}


// Fetch Notices

$sql = "SELECT * FROM notices ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
$notices = mysqli_fetch_all($result, MYSQLI_ASSOC);

include __DIR__ . '/../html/notices.html.php';
?>
