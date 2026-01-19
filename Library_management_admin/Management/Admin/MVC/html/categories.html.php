<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Library Admin</title>
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/categories.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <a href="dashboard_controller.php" class="back-link">&larr; Back to Dashboard</a>
        
        <h1>Manage Categories</h1>


        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if ($error): ?>

            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>






        <!-- Add Category Form -->
        <div class="card">
            <h3>Add New Category</h3>
            <form action="category_controller.php" method="POST" class="form-inline">
                <input type="hidden" name="action" value="add">
                <input type="text" name="name" placeholder="Category Name" required>
                <button type="submit">Add Category</button>
            </form>
        </div>

        <!-- Category List -->
        <h3>Category List</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?php echo $cat['id']; ?></td>
                    <td><?php echo htmlspecialchars($cat['name']); ?></td>
                    <td>
                        <form action="category_controller.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
                            <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($categories)): ?>
                <tr><td colspan="3">No categories found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="../js/category_validation.js"></script>
 </body>
</html>
