<script>
$(document).ready(function () {

    // Testimonial Slider
    $('.testimonial-slider').slick({
        dots: true,
        arrows: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3200,
        speed: 500,
        prevArrow: '<button class="slick-prev"><i data-lucide="chevron-left"></i></button>',
        nextArrow: '<button class="slick-next"><i data-lucide="chevron-right"></i></button>',
        responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 2 } },
            { breakpoint: 640, settings: { slidesToShow: 1, arrows: false } }
        ]
    });

    // About slider
    $('.about-slider').slick({
        dots: true,
        arrows: false,
        infinite: true,
        fade: true,
        speed: 600,
        autoplay: true,
        autoplaySpeed: 2300,
        cssEase: 'ease-in-out',
    });

    setTimeout(() => { lucide.createIcons(); }, 200);
});
</script>
