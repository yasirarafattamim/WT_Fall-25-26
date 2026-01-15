<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Returns - Library Admin</title>
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/returns.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <a href="dashboard_controller.php" class="back-link">&larr; Back to Dashboard</a>
        
        <h1>Track Returns</h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Book</th>
                    <th>Issue Date</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loans as $loan): ?>
                <tr>
                    <td><?php echo $loan['id']; ?></td>
                    <td><?php echo htmlspecialchars($loan['username']); ?></td>
                    <td><?php echo htmlspecialchars($loan['book_title']); ?></td>
                    <td><?php echo $loan['issue_date']; ?></td>
                    <td><?php echo $loan['due_date']; ?></td>
                    <td>
                        <form action="return_controller.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="return">
                            <input type="hidden" name="loan_id" value="<?php echo $loan['id']; ?>">
                            <button type="submit" class="btn-warning" onclick="return confirm('Mark this book as returned?');">Mark Returned</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($loans)): ?>
                <tr><td colspan="6">No books currently issued.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
