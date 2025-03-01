let jelszoInputok = document.querySelectorAll("#InputPassword");
let eyeIcons = document.querySelectorAll("#eyeIcon");

eyeIcons.forEach((eyeIcon, index) => {
    eyeIcon.addEventListener("click", function() {
    jelszoInput = jelszoInputok[index];
    if (jelszoInput.type === "password") {
        jelszoInput.type = "text";
        eyeIcon.src = "images/visible.png"; 
    } else {
        jelszoInput.type = "password";
        eyeIcon.src = "images/hidden.png"; 
    }})
});