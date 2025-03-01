function showMessage(type, message) {
    let messageBox = document.getElementById(type + "-message");
    let messageText = document.getElementById(type + "-text");

    // Ha a span nem létezik, létrehozzuk
    if (!messageText) {
        messageText = document.createElement("span");
        messageText.id = type + "-text";

    }

    if (messageBox && messageText) {
        messageText.innerText = message; // Üzenet beállítása
        messageBox.classList.add("show-message"); // Megjelenítés
        messageBox.showModal(); // Modal megjelenítése

        setTimeout(() => {
            hideMessage(type + "-message");
        }, 3000); // 3 másodperc után eltűnik 
    } else {
        console.error(`Nem található a(z) ${type}-message elem.`);
    }
}

// Üzenet eltüntetése
function hideMessage(id) {
    let messageBox = document.getElementById(id);
    if (messageBox) {
        messageBox.classList.remove("show-message"); // Eltűnés animáció
           setTimeout(() => {
             messageBox.close(); // Modal bezárása
         }, 300); // Várunk az animáció befejezésére  
    } else {
        console.error(`Nem található a(z) ${id} elem.`);
    }
}

// Üzenet fogadása PHP-ból
window.addEventListener("message", function (event) {
    if (event.data.success) {
        showMessage("success", event.data.success);
    }
    if (event.data.loginError) {
        showMessage("error", event.data.loginError);
    }
});