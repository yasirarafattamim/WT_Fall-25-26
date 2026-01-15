<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Requests - Library Admin</title>
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/requests.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <a href="dashboard_controller.php" class="back-link">&larr; Back to Dashboard</a>
        
        <h1>Loan Requests</h1>

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
                    <th>Requested At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $req): ?>
                <tr>
                    <td><?php echo $req['id']; ?></td>
                    <td><?php echo htmlspecialchars($req['username']); ?></td>
                    <td><?php echo htmlspecialchars($req['book_title']); ?></td>
                    <td><?php echo $req['created_at']; ?></td>
                    <td>
                        <form action="request_controller.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="approve">
                            <input type="hidden" name="loan_id" value="<?php echo $req['id']; ?>">
                            <button type="submit" class="btn-success">Approve</button>
                        </form>
                        <form action="request_controller.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="reject">
                            <input type="hidden" name="loan_id" value="<?php echo $req['id']; ?>">
                            <button type="submit" class="btn-danger" onclick="return confirm('Reject this request?');">Reject</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($requests)): ?>
                <tr><td colspan="5">No pending requests.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
