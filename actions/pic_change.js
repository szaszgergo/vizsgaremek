let passwordInput = document.getElementById("InputPassword");
let eyeIcon = document.getElementById("eyeIcon");

eyeIcon.addEventListener("click", function() {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.src = "images/visible.png"; 
    } else {
        passwordInput.type = "password";
        eyeIcon.src = "images/hidden.png"; 
    }
});