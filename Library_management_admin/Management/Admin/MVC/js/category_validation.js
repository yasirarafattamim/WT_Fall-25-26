// Management/Admin/MVC/js/category_validation.js

document.addEventListener('DOMContentLoaded', function () {
    const categoryForm = document.querySelector('form[action="category_controller.php"]');

    if (categoryForm) {
        categoryForm.addEventListener('submit', function (event) {
            const nameInput = categoryForm.querySelector('input[name="name"]');

            if (!nameInput.value.trim()) {
                alert('Please enter a category name.');
                nameInput.focus();
                event.preventDefault();
                return;
            }
        });
    }
});
