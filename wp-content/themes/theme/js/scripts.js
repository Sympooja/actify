jQuery(document).ready(function () {

    jQuery(".header-top-left-slider").slick({
        dots: false,
        autoplay: true,
        infinite: true,
        arrows: false,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    jQuery(".home-section-3-repeater").slick({
        dots: false,
        autoplay: false,
        infinite: true,
        arrows: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 600,
            settings: {
                arrows: false,
                autoplay: true,
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        }
        ],
    });

    jQuery(".home-section-5-testimonial").slick({
        dots: false,
        autoplay: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1.1,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        }
        ],
    });

    jQuery(".home-section-4-slider").slick({
        dots: false,
        autoplay: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
            },
        },

        {
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        }
        ],
    });



});