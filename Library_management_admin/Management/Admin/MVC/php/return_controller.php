<?php
// Management/Admin/MVC/php/return_controller.php
require_once __DIR__ . '/middleware.php';
require_once __DIR__ . '/../db/db.php';

requireAuth();

$message = '';
$error = '';

// Handle Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'return' && isset($_POST['loan_id'])) {
        $loan_id = (int)$_POST['loan_id'];
        
        // Return Logic with Transaction
        mysqli_begin_transaction($conn);
        try {
            // Get book_id
            $sql = "SELECT book_id FROM loans WHERE id = $loan_id";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) === 0) throw new Exception("Loan not found");
            $book_id = mysqli_fetch_assoc($res)['book_id'];

            // Update Loan Status
            $return_date = date('Y-m-d');
            $sql = "UPDATE loans SET status = 'returned', return_date = '$return_date' WHERE id = $loan_id";
            mysqli_query($conn, $sql);

            // Increment Stock
            $sql = "UPDATE books SET quantity_available = quantity_available + 1 WHERE id = $book_id";
            mysqli_query($conn, $sql);

            mysqli_commit($conn);
            $_SESSION['message'] = "Book marked as returned successfully.";
        } catch (Exception $e) {
            mysqli_rollback($conn);
            $_SESSION['error'] = "Failed to mark book as returned.";
        }
    }
    header("Location: return_controller.php");
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

// Fetch Issued Loans
$sql = "SELECT l.id, u.username, b.title as book_title, l.issue_date, l.due_date, l.status 
        FROM loans l 
        JOIN users u ON l.user_id = u.id 
        JOIN books b ON l.book_id = b.id 
        WHERE l.status = 'issued' 
        ORDER BY l.issue_date DESC";
$result = mysqli_query($conn, $sql);
$loans = mysqli_fetch_all($result, MYSQLI_ASSOC);

include __DIR__ . '/../html/returns.html.php';
?>
