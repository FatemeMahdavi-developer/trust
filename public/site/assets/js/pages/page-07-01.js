$(document).ready
(
    function()
    {
        // top news
        $(' .blog-top-items').slick
        ({
            speed: 400,
            infinite: true,
            //autoplay: true,
            pauseOnHover: true,
            autoplaySpeed: 5000,
            dots: false,
            arrows: true,
            slidesToShow: 3,
            rtl: true,
            responsive:
                [
                    {
                        breakpoint: 1199,
                        settings: {slidesToShow: 3}
                    },
                    {
                        breakpoint: 991,
                        settings: {slidesToShow: 2}
                    },
                    {
                        breakpoint: 767,
                        settings: {slidesToShow: 2}
                    },
                    {
                        breakpoint: 567,
                        settings: {slidesToShow: 1}
                    }
                ]
        });
    }
);
