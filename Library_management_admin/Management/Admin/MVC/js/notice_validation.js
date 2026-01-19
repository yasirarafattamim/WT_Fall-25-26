// Management/Admin/MVC/js/notice_validation.js

document.addEventListener('DOMContentLoaded', function () {
    const noticeForm = document.querySelector('form[action="notice_controller.php"]');





    if (noticeForm) {
        noticeForm.addEventListener('submit', function (event) {
            const title = noticeForm.querySelector('input[name="title"]');
            const content = noticeForm.querySelector('textarea[name="content"]');

            if (!title.value.trim()) {
                alert('Please enter a title for the notice.');
                title.focus();
                event.preventDefault();
                
                return;
            }










            if (!content.value.trim()) {
                alert('Please enter the content of the notice.');
                content.focus();
                event.preventDefault();
                return;
            }
        });
    }
});
