<style>
    #success-message,
    #error-message {
        width: 90%;
        max-width: 500px;
        padding: 15px;
        border-radius: 5px;
        text-align: center;
        font-size: 1.2rem;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;
        z-index: 1000;
        position: fixed;
        top: 50%;
        left: 1%;
    }

    #error-message {
        background-color: #dc3545;
        color: white;
        transform: translate(0%, -850%);

    }

    #success-message {
        background-color: #28a745;
        color: white;
        transform: translate(0%, -650%);

    }

    /* Megjelenéskor */
    .show-message {
        opacity: 1 !important;
        visibility: visible !important;
    }

   
</style>

<dialog id="success-message">
    <button class="close-btn" onclick="hideMessage('success-message')"></button>
    <span id="success-text"></span>
</dialog>


<dialog id="error-message" class="alert alert-danger">
    <button class="close-btn" onclick="hideMessage('error-message')"></button>
    <span id="error-text"></span>
</dialog>
