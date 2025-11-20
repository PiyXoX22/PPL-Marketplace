<style>
    .chat-wa-btn {
        position: fixed;
        bottom: 25px;
        right: 25px;
        background: #25D366;
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 32px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        transition: .3s;
        z-index: 999;
    }

    .chat-wa-btn:hover {
        transform: scale(1.1);
        background: #1ebe5d;
    }

    .wa-icon {
        width: 32px;
        height: 32px;
        filter: brightness(0) invert(1); /* Biar icon putih */
    }
</style>

<!-- Tombol WhatsApp -->
<a
    href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20butuh%20bantuan"
    target="_blank"
    class="chat-wa-btn"
>
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="wa-icon">
</a>
