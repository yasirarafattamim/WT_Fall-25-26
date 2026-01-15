<?php
// Management/Admin/MVC/php/request_controller.php
require_once __DIR__ . '/middleware.php';
require_once __DIR__ . '/../db/db.php';

requireAuth();

$message = '';
$error = '';

// Handle Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['loan_id'])) {
        $loan_id = (int)$_POST['loan_id'];
        
        if ($_POST['action'] === 'approve') {
            // Approve Logic with Transaction
            mysqli_begin_transaction($conn);
            try {
                // Get book_id
                $sql = "SELECT book_id FROM loans WHERE id = $loan_id";
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) === 0) throw new Exception("Loan not found");
                $book_id = mysqli_fetch_assoc($res)['book_id'];

                // Check availability
                $sql = "SELECT quantity_available FROM books WHERE id = $book_id FOR UPDATE";
                $res = mysqli_query($conn, $sql);
                $qty = mysqli_fetch_assoc($res)['quantity_available'];

                if ($qty > 0) {
                    // Update Loan Status
                    $issued_date = date('Y-m-d');
                    $due_date = date('Y-m-d', strtotime('+14 days'));
                    $sql = "UPDATE loans SET status = 'issued', issue_date = '$issued_date', due_date = '$due_date' WHERE id = $loan_id";
                    mysqli_query($conn, $sql);

                    // Decrement Stock
                    $sql = "UPDATE books SET quantity_available = quantity_available - 1 WHERE id = $book_id";
                    mysqli_query($conn, $sql);

                    mysqli_commit($conn);
                    $_SESSION['message'] = "Loan request approved and book issued.";
                } else {
                    mysqli_rollback($conn);
                    $_SESSION['error'] = "Failed to approve loan. Book might be out of stock.";
                }
            } catch (Exception $e) {
                mysqli_rollback($conn);
                $_SESSION['error'] = "Failed to approve loan.";
            }

        } elseif ($_POST['action'] === 'reject') {
            $sql = "UPDATE loans SET status = 'rejected' WHERE id = $loan_id";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "Loan request rejected.";
            } else {
                $_SESSION['error'] = "Failed to reject loan.";
            }
        }
    }
    header("Location: request_controller.php");
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

// Fetch Requests
$sql = "SELECT l.id, l.book_id, u.username, b.title as book_title, l.created_at, l.status 
        FROM loans l 
        JOIN users u ON l.user_id = u.id 
        JOIN books b ON l.book_id = b.id 
        WHERE l.status = 'requested' 
        ORDER BY l.created_at ASC";
$result = mysqli_query($conn, $sql);
$requests = mysqli_fetch_all($result, MYSQLI_ASSOC);

include __DIR__ . '/../html/requests.html.php';
?>
