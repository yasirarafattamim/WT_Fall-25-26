<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books - Library Admin</title>
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/books.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <a href="dashboard_controller.php" class="back-link">&larr; Back to Dashboard</a>
        
        <h1>Manage Books</h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Add Book Form -->
        <div class="card book-form-card">
            <h3>Add New Book</h3>
            <form action="book_controller.php" method="POST">
                <input type="hidden" name="action" value="add">
                <div class="form-grid">
                    <div>
                        <label>Title</label>
                        <input type="text" name="title" required class="form-input">
                    </div>
                    <div>
                        <label>Author</label>
                        <input type="text" name="author" required class="form-input">
                    </div>
                    <div>
                        <label>ISBN</label>
                        <input type="text" name="isbn" required class="form-input">
                    </div>
                    <div>
                        <label>Category</label>
                        <select name="category_id" required class="form-input">
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label>Quantity</label>
                        <input type="number" name="quantity" min="1" required class="form-input">
                    </div>
                </div>
                <button type="submit" class="btn-primary">Add Book</button>
            </form>
        </div>

        <!-- Book List -->
        <h3>Book List</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Category</th>
                    <th>Qty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php echo $book['id']; ?></td>
                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                    <td><?php echo htmlspecialchars($book['author']); ?></td>
                    <td><?php echo htmlspecialchars($book['isbn']); ?></td>
                    <td><?php echo htmlspecialchars($book['category_name'] ?? 'N/A'); ?></td>
                    <td><?php echo $book['quantity_available'] . '/' . $book['quantity_total']; ?></td>
                    <td>
                        <form action="book_controller.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                            <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($books)): ?>
                <tr><td colspan="7">No books found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="../js/book_validation.js"></script>
</body>
</html>
