<!-- SCROLL TO TOP -->
<button id="scrollTopBtn">
    ↑
</button>

<style>
/* ================= BUTTON ================= */
#scrollTopBtn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 999;

    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: none;

    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    font-size: 20px;
    font-weight: bold;

    cursor: pointer;

    display: flex;
    align-items: center;
    justify-content: center;

    /* hidden default */
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);

    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(59,130,246,0.4);
}

/* SHOW */
#scrollTopBtn.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* HOVER */
#scrollTopBtn:hover {
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 12px 25px rgba(59,130,246,0.6);
}

/* ACTIVE CLICK */
#scrollTopBtn:active {
    transform: scale(0.95);
}

/* DARK MODE */
.dark #scrollTopBtn {
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    box-shadow: 0 8px 20px rgba(59,130,246,0.5);
}

/* ================= MOBILE ================= */
@media (max-width: 768px) {
    #scrollTopBtn {
        width: 45px;
        height: 45px;
        font-size: 18px;
        bottom: 20px;
        right: 20px;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const btn = document.getElementById("scrollTopBtn");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 200) {
            btn.classList.add("show");
        } else {
            btn.classList.remove("show");
        }
    });

    btn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

});
</script>