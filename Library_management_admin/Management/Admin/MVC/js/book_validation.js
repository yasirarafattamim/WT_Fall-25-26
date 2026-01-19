// Management/Admin/MVC/js/book_validation.js

document.addEventListener('DOMContentLoaded', function () {
    // Select the form checking for specific inputs or action
    const bookForm = document.querySelector('form[action="book_controller.php"] input[value="add"]').closest('form');

    
    if (bookForm) {
        bookForm.addEventListener('submit', function (event) {
            let isValid = true;
            const title = bookForm.querySelector('input[name="title"]');
            const author = bookForm.querySelector('input[name="author"]');
            const isbn = bookForm.querySelector('input[name="isbn"]');
            const category = bookForm.querySelector('select[name="category_id"]');
            const quantity = bookForm.querySelector('input[name="quantity"]');

            if (!title.value.trim()) {
                alert('Please enter a valid title.');
                title.focus();
                event.preventDefault();
                return;
            }


            if (!author.value.trim()) {
                alert('Please enter an author name.');
                author.focus();
                event.preventDefault();
                return;
            }

            if (!isbn.value.trim()) {
                alert('Please enter an ISBN.');
                isbn.focus();
                event.preventDefault();
                return;
            }

            if (!category.value) {
                alert('Please select a category.');
                category.focus();
                event.preventDefault();
                return;
            }

            if (!quantity.value || parseInt(quantity.value) < 1) {
                alert('Quantity must be at least 1.');
                quantity.focus();
                event.preventDefault();
                return;
            }
        });
    }
});
