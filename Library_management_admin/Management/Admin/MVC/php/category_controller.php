<?php
// Management/Admin/MVC/php/category_controller.php
require_once __DIR__ . '/middleware.php';
require_once __DIR__ . '/../db/db.php';

requireAuth();

$message = '';
$error = '';

// Handle Actions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $name = mysqli_real_escape_string($conn, trim($_POST['name'] ?? ''));
            if (!empty($name)) {
                try {
                    $sql = "INSERT INTO categories (name) VALUES ('$name')";
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['message'] = "Category added successfully.";
                    } else {
                        $_SESSION['error'] = "Failed to add category. Name might be duplicate.";
                    }
                } catch (Exception $e) {
                    $_SESSION['error'] = "Error: " . $e->getMessage();
                }
            } else {
                $_SESSION['error'] = "Category name cannot be empty.";
            }
        } elseif ($_POST['action'] === 'delete') {
            $id = (int)$_POST['id'];
            $sql = "DELETE FROM categories WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "Category deleted successfully.";
            } else {
                $_SESSION['error'] = "Failed to delete category.";
            }
        }
    }
    // Redirect after POST
    header("Location: category_controller.php");
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

// Fetch Categories
$sql = "SELECT * FROM categories ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

include __DIR__ . '/../html/categories.html.php';
?>
