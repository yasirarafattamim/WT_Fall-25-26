<?php
// Management/Admin/MVC/php/book_controller.php
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
            $author = mysqli_real_escape_string($conn, trim($_POST['author'] ?? ''));
            $isbn = mysqli_real_escape_string($conn, trim($_POST['isbn'] ?? ''));
            $category_id = (int)$_POST['category_id'];
            $quantity = (int)$_POST['quantity'];

            if (!empty($title) && !empty($author) && !empty($isbn) && $quantity > 0) {
                try {
                    $sql = "INSERT INTO books (title, author, isbn, category_id, quantity_total, quantity_available) 
                            VALUES ('$title', '$author', '$isbn', $category_id, $quantity, $quantity)";
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['message'] = "Book added successfully.";
                    } else {
                        $_SESSION['error'] = "Failed to add book. ISBN might be duplicate.";
                    }
                } catch (Exception $e) {
                    $_SESSION['error'] = "Error: " . $e->getMessage();
                }
            } else {
                $_SESSION['error'] = "Please fill in all fields correctly.";
            }
        } elseif ($_POST['action'] === 'delete') {
            $id = (int)$_POST['id'];
            $sql = "DELETE FROM books WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "Book deleted successfully.";
            } else {
                $_SESSION['error'] = "Failed to delete book.";
            }
        }
    }
    header("Location: book_controller.php");
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

// Fetch Data
$sql_books = "SELECT b.*, c.name as category_name FROM books b LEFT JOIN categories c ON b.category_id = c.id ORDER BY b.created_at DESC";
$result_books = mysqli_query($conn, $sql_books);
$books = mysqli_fetch_all($result_books, MYSQLI_ASSOC);

$sql_cats = "SELECT * FROM categories ORDER BY created_at DESC";
$result_cats = mysqli_query($conn, $sql_cats);
$categories = mysqli_fetch_all($result_cats, MYSQLI_ASSOC);

include __DIR__ . '/../html/books.html.php';
?>
