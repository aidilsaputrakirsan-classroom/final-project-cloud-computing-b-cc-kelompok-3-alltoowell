<style>
    .light-dots {
        background-image: radial-gradient(rgba(0,0,0,0.06) 1px, transparent 1px);
        background-size: 22px 22px;
    }

    .testi-card {
        border-radius: 28px;
        padding: 32px;
        background: linear-gradient(145deg, rgba(255,255,255,0.9), rgba(240,245,255,0.95));
        backdrop-filter: blur(12px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        transition: .25s;
    }

    .testi-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 22px 50px rgba(0,0,0,0.14);
    }

    .slick-prev, .slick-next {
        width: 44px;
        height: 44px;
        background: white;
        border-radius: 50%;
        display: flex !important;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: none;
        z-index: 20;
    }

    .slick-prev:hover, .slick-next:hover {
        background: #eef4ff;
    }

    .slick-dots li button:before {
        color: #0A3A82 !important;
        opacity: .8;
        font-size: 10px;
    }
</style>
