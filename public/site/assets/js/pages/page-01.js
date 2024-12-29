$(document).ready
(
    function()
    {
        // slider
        var $slider = $('.page-home .page-slider-items');

        $slider.on('init', function(event, slick)
        {
            sliderPageNumber(1, slick.slideCount)
        });

        $slider.on('afterChange', function(event, slick, currentSlide)
        {
            sliderPageNumber(currentSlide + 1, slick.slideCount)
        });

        $slider.slick
        ({
            slidesToScroll: 1,
            fade: true,
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            speed: 1000,
            infinite: true,
            autoplay: true,
            pauseOnHover: true,
            autoplaySpeed: 10000,
            dots: false,
            arrows: true,
            slidesToShow: 1,
            rtl: true,
            nextArrow: '.container-page-slider .slick-next-custom',
            prevArrow: '.container-page-slider .slick-prev-custom',
            touchThreshold: 100,
        });

        function sliderPageNumber(currentSlide, slideCount)
        {
            var $obj = $('.page-home .container-page-slider');
            var c = '<span class="active">' + currentSlide + '</span>/' + slideCount;

            // if($obj.find('.slick-counter').length === 0)
            //     $obj.append('<div class="slick-counter">' + c + '</div>');
            // else
                $obj.find('.slick-counter').html(c);
        }

        // product
        $('.page-home .product-items').slick
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



        // top blog
        $('.page-home .blog-top-items').slick
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

        // certificate
        $('.page-home .certificate-items').slick
        ({
            speed: 400,
            infinite: true,
            //autoplay: true,
            pauseOnHover: true,
            autoplaySpeed: 5000,
            dots: false,
            arrows: true,
            slidesToShow: 4,
            rtl: true,
            responsive:
                [
                    {
                        breakpoint: 1199,
                        settings: {slidesToShow: 4}
                    },
                    {
                        breakpoint: 991,
                        settings: {slidesToShow: 4}
                    },
                    {
                        breakpoint: 767,
                        settings: {slidesToShow: 3}
                    },
                    {
                        breakpoint: 567,
                        settings: {slidesToShow: 2}
                    }
                ]
        });

        // instagram
        $('.page-home .instagram-items').slick
        ({
            speed: 400,
            infinite: true,
            //autoplay: true,
            pauseOnHover: true,
            autoplaySpeed: 5000,
            dots: false,
            arrows: false,
            slidesToShow: 5,
            rtl: true,
            responsive:
                [
                    {
                        breakpoint: 1199,
                        settings: {slidesToShow: 5}
                    },
                    {
                        breakpoint: 991,
                        settings: {slidesToShow: 4}
                    },
                    {
                        breakpoint: 767,
                        settings: {slidesToShow: 3}
                    },
                    {
                        breakpoint: 567,
                        settings: {slidesToShow: 2}
                    }
                ]
        });

        // // video
        // $(".page-home .col-video .icon").click
        // (
        //     function()
        //     {
        //         $(this).hide();
        //         $(".page-home .col-video .video-poster").hide();
        //         $(".page-home .col-video video").trigger("play").attr("controls", true).show();
        //     }
        // );
    }
);
