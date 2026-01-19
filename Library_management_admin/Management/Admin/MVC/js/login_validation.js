// Management/Admin/MVC/js/login_validation.js

document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('form');
    
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            let isValid = true;
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            
            // Clear previous errors (if any specific error elements existed, but we rely on browser alerts or custom logic)
            // For now, simple alerts or checking value presence as required attribute handles basic empty check,
            // but we add explicit JS check as requested.
            

            if (!usernameInput.value.trim()) {
                alert('Please enter your username.');
                usernameInput.focus();
                isValid = false;
                event.preventDefault();
                return;
            }


            

            if (!passwordInput.value.trim()) {
                alert('Please enter your password.');
                passwordInput.focus();
                isValid = false;
                event.preventDefault();
                return;
            }
        });
    }
});
