<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Notices - Library Admin</title>
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/notices.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <a href="dashboard_controller.php" class="back-link">&larr; Back to Dashboard</a>
        
        <h1>Manage Notices</h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Add Notice Form -->
        <div class="card notice-form-card">
            <h3>Post New Notice</h3>
            <form action="notice_controller.php" method="POST">
                <input type="hidden" name="action" value="add">
            <div class="form-row">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" required class="form-input">
                </div>
                <div class="form-row">
                    <label class="form-label">Content</label>
                    <textarea name="content" rows="4" required class="form-input"></textarea>
                </div>
                <button type="submit" class="btn-primary">Post Notice</button>
            </form>
        </div>

        <!-- Notice List -->
        <h3>Recent Notices</h3>
        <div class="notice-list">
            <?php foreach ($notices as $notice): ?>
            <div class="notice-card">
                <h4 class="notice-title"><?php echo htmlspecialchars($notice['title']); ?></h4>
                <p class="notice-date">Posted on: <?php echo $notice['created_at']; ?></p>
                <div class="notice-content">
                    <?php echo nl2br(htmlspecialchars($notice['content'])); ?>
                </div>
                <form action="notice_controller.php" method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo $notice['id']; ?>">
                    <button type="submit" class="btn-danger" onclick="return confirm('Delete this notice?');">Delete</button>
                </form>
            </div>
            <?php endforeach; ?>
            <?php if (empty($notices)): ?>
                <p>No notices posted yet.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="../js/notice_validation.js"></script>
</body>
</html>
