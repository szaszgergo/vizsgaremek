window.addEventListener("message", function(event) {
    if (event.data.loginError) {
        // lekéri a registeraction.php fájlból a számokat és megjeleníti
        if (event.data.newCaptcha) {
            document.querySelector('label[for="InputCaptcha"]').innerText = `Számítsa ki az eredményt: ${event.data.newCaptcha.num1} + ${event.data.newCaptcha.num2} = `;
        }
    }
});