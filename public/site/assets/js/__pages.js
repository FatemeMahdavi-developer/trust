$(document).ready
(
    function()
    {
        // menu
        $(".menu .col-level-2 a").mouseenter
        (
            function()
            {
                let catId = $(this).attr("data-cat-id");

                $(".menu .col-level-2 a, .menu .col-level-3").removeClass("active");
                $(".menu .col-level-2 a[data-cat-id=" + catId + "]").addClass("active");
                $(".menu .col-level-3[data-cat-id=" + catId + "]").addClass("active");
            }
        );

        $('.menu .level-1').mouseenter
        (
            function()
            {
                $(this).doTimeout
                (
                    'hover',
                    300,
                    function(elem)
                    {
                        $(this).addClass("active");
                        $(this).find(".level-2").slideDown();
                    }
                );
            }
        ).mouseleave
        (
            function()
            {
                $(this).doTimeout
                (
                    'hover',
                    300,
                    function(elem)
                    {
                        $(this).removeClass("active");
                        $(this).find(".level-2").slideUp();
                    }
                );
            }
        );

        // sign in
        $('.btn-form-sign-in-password').click
        (
            function()
            {
                if($('.form-sign-in-password').attr('type') === 'text')
                {
                    $('.form-sign-in-password').attr('type', 'password');
                    $('.btn-form-sign-in-password').removeClass('bi-eye-slash').addClass('bi-eye');
                }
                else
                {
                    $('.form-sign-in-password').attr('type', 'text');
                    $('.btn-form-sign-in-password').removeClass('bi-eye').addClass('bi-eye-slash');
                }
            }
        );

        // mobile side menu
        $('.mobile-side-menu .nav-dropdown-toggle').click
        (
            function()
            {
                $(this).toggleClass('open');
                $(this.nextElementSibling).slideToggle();

                return false;
            }
        );

        // checkbox new style
        $('.label-input-checkbox-by-style input').change
        (
            function()
            {
                $(this).parents('label').toggleClass('active-checked');
            }
        );
    }
);

$(document).ready
(
    function()
    {
        // slider
        $('.page-home .page-slider-items').slick
        ({
            slidesToScroll: 1,
            speed: 400,
            infinite: true,
            autoplay: true,
            pauseOnHover: true,
            autoplaySpeed: 7000,
            dots: true,
            arrows: true,
            slidesToShow: 1,
            rtl: true,
        });

        // category
        $('.page-home .category-items').slick
        ({
            speed: 400,
            infinite: true,
            //autoplay: true,
            pauseOnHover: true,
            autoplaySpeed: 5000,
            dots: false,
            arrows: true,
            slidesToShow: 5,
            rtl: true,
            responsive:
                [
                    {
                        breakpoint: 1199,
                        settings: {slidesToShow: 4}
                    },
                    {
                        breakpoint: 991,
                        settings: {slidesToShow: 3}
                    },
                    {
                        breakpoint: 767,
                        settings: {slidesToShow: 2}
                    },
                    {
                        breakpoint: 567,
                        settings: {slidesToShow: 2}
                    }
                ]
        });

        // offer
        $('.page-home .offer-slide-items').slick
        ({
            slidesToScroll: 1,
            speed: 400,
            infinite: true,
            autoplay: true,
            pauseOnHover: true,
            autoplaySpeed: 5000,
            dots: true,
            arrows: false,
            slidesToShow: 1,
            rtl: true,
        }).on
        (
            'beforeChange',
            function(event, slick, currentSlide, nextSlide)
            {
                $('.page-home .offer-items .item').removeClass('active');
                $('.page-home .offer-items .item:eq(' + nextSlide + ')').addClass('active');
            }
        );

        $('.offer-items .item').click
        (
            function()
            {
                $('.page-home .offer-slide-items').slick('slickGoTo', $(this).index());
            }
        );

        // blog
        $('.page-home .blog-slide-items').slick
        ({
            slidesToScroll: 1,
            speed: 400,
            infinite: true,
            autoplay: true,
            pauseOnHover: true,
            autoplaySpeed: 5000,
            dots: false,
            arrows: true,
            slidesToShow: 1,
            rtl: true,
        });


        // products
        $('.page-home .products-items').slick
        ({
            slidesToScroll: 1,
            autoplay: false,
            speed: 400,
            infinite: false,
            dots: false,
            arrows: true,
            slidesToShow: 5,
            rtl: true,
            responsive:
                [
                    {
                        breakpoint: 1199,
                        settings: {slidesToShow: 4}
                    },
                    {
                        breakpoint: 991,
                        settings: {slidesToShow: 3}
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

        // brand
        $('.page-home .brand-items').slick
        ({
            speed: 400,
            infinite: true,
            //autoplay: true,
            pauseOnHover: true,
            autoplaySpeed: 5000,
            dots: false,
            arrows: true,
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
                    },
                    {
                        breakpoint: 400,
                        settings: {slidesToShow: 2}
                    }
                ]
        });
    }
);

$(document).ready
(
    function()
    {
        $('.btn-form-sign-up-password').click
        (
            function()
            {
                if($('.form-sign-up-password').attr('type') === 'text')
                {
                    $('.form-sign-up-password').attr('type', 'password');
                    $('.btn-form-sign-up-password').removeClass('bi-eye-slash').addClass('bi-eye');
                }
                else
                {
                    $('.form-sign-up-password').attr('type', 'text');
                    $('.btn-form-sign-up-password').removeClass('bi-eye').addClass('bi-eye-slash');
                }
            }
        );
    }
);

$(document).ready
(
    function()
    {
        $('.page-products .product-sort').select2
        ({
            language: "fa",
            dir: "rtl"
        });

        //
        $(".page-products .has-scrollbar").mCustomScrollbar();

        // filter price
        $(".page-products .filter-price-slider").slider
        ({
            range: true,
            min: 0,
            isRTL: true,
            max: 20000000,
            values: [0, 20000000],
            slide: function (event, ui)
            {
                $(".page-products .filter-price-from").val(ui.values[0]);
                $(".page-products .filter-price-to").val(ui.values[1]);

                $(".page-products .filter-price-slider-box .price-from").html((ui.values[0]).priceFormat());
                $(".page-products .filter-price-slider-box .price-to").html((ui.values[1]).priceFormat());
            }
        });

        // show & close filter
        $('.page-products .btn-filter-view').click
        (
            function()
            {
                $('.page-products .filter-box').toggleClass('show');

                return false;
            }
        );
        $('.page-products .btn-filter-close').click
        (
            function()
            {
                $('.page-products .filter-box').toggleClass('show');

                return false;
            }
        );

        //
        $('.page-products .container-products .filter-section .filter-section-title').click
        (
            function()
            {
                $(this).parent().toggleClass('show');
            }
        );

        $('.page-products .container-product-list-des .btn-des-change').click
        (
            function()
            {
                $('.page-products .container-product-list-des .des-box').toggleClass('full-height');

                return false;
            }
        );

        // popover
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map
        (
            function (popoverTriggerEl)
            {
                return new bootstrap.Popover(popoverTriggerEl, {html: true});
            }
        );

        // category menu
        $('.page-products .menu-category .nav-dropdown-toggle').click
        (
            function()
            {
                $(this).toggleClass('open');
                $(this.nextElementSibling).slideToggle();

                return false;
            }
        );
    }
);

Number.prototype.priceFormat = function(n, x)
{
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

$(document).ready
(
    function()
    {
        $('.page-product .product-size').select2
        ({
            language: "fa",
            dir: "rtl"
        });

        // scroll
        if(window.location.hash !== '') $('html,body').animate({scrollTop: $(window.location.hash).offset().top}, 'slow');

        // color box
        $('.page-product .label-input-colorbox-by-style input').change
        (
            function()
            {
                $('.page-product .label-input-colorbox-by-style').removeClass('active-checked');
                $(this).parents('label').addClass('active-checked');


            }
        );

        // light gallery
        $('.page-product .image-thumbnail').lightGallery({selector: '.item-main'});
        $('.page-product .images-box .image-big-box, .page-product .image-thumbnail .item-more').click
        (
            function()
            {
                $('.page-product .image-thumbnail .item-main:eq(0)').click();

                return false;
            }
        );

        // btn increase & decrease
        $('.page-product .icon-increase').click
        (
            function()
            {
                var n = parseInt($(this).parent().find('.product-number').val());

                $(this).parent().find('.product-number').val(n + 1)
            }
        );

        $('.page-product .icon-decrease').click
        (
            function()
            {
                var n = parseInt($(this).parent().find('.product-number').val());

                $(this).parent().find('.product-number').val(n - 1 > 0 ? n - 1 : 0)
            }
        );
    }
);

$(document).ready
(
    function()
    {
        $('.page-basket .icon-increase').click
        (
            function()
            {
                var n = parseInt($(this).parent().find('.product-number').val());

                $(this).parent().find('.product-number').val(n + 1)
            }
        );

        $('.page-basket .icon-decrease').click
        (
            function()
            {
                var n = parseInt($(this).parent().find('.product-number').val());

                $(this).parent().find('.product-number').val(n - 1 > 0 ? n - 1 : 0)
            }
        );
    }
);

$(document).ready
(
    function()
    {
        $('.page-basket-account .form-sign-up-legal-checkbox').change
        (
            function()
            {
                $('.page-basket-account .legal-input-box').toggleClass('enable');
            }
        );
    }
);

$(document).ready
(
    function()
    {
        $('.page-basket-shipping .form-select').select2
        ({
            language: "fa",
            dir: "rtl"
        });

        //
        $(".page-basket-shipping .address-box label").click
        (
            function()
            {
                $(".page-basket-shipping .address-box").removeClass("active");
                $(this).parent().addClass("active");
            }
        );

        $(".page-basket-shipping .delivery-type-box").click
        (
            function()
            {
                $(".page-basket-shipping .delivery-type-box").removeClass("active");
                $(this).addClass("active");
            }
        );

        $(".page-basket-shipping .day-box label").click
        (
            function()
            {
                $(".page-basket-shipping .day-box label").removeClass("active");
                $(this).addClass("active");
            }
        );

        $(".page-basket-shipping .modal-delivery-time-box label").click
        (
            function()
            {
                $(".page-basket-shipping .modal-delivery-time-box label").removeClass("active");
                $(this).addClass("active");
            }
        );
    }
);

$(document).ready
(
    function()
    {
        $('.page-basket-checkout .form-payment-card-account-number').select2
        ({
            language: "fa",
            dir: "rtl"
        });

        //
        $(".page-basket-checkout .label-payment").click
        (
            function()
            {
                $(".page-basket-checkout .label-payment").removeClass("active");
                $(this).addClass("active");

                if($(".page-basket-checkout .label-payment input:checked").val() === 'card')
                {
                    $(".page-basket-checkout .payment-card-data").slideToggle();
                }
                else if($(".page-basket-checkout .label-payment input:checked").val() === 'bank-online')
                {
                    $(".page-basket-checkout .payment-bank-online-data").slideToggle();
                }
            }
        );

        $(".page-basket-checkout .payment-bank-online-data .label-payment-bank-online").click
        (
            function()
            {
                $(".page-basket-checkout .payment-bank-online-data .label-payment-bank-online").removeClass("active");
                $(this).addClass("active");
            }
        );

        $(".page-basket-checkout .payment-card-data .input-date").datepicker
        (
            {
                dateFormat: 'yy/mm/dd',
                // changeMonth: true,
                // changeYear: true,
                yearRange: '1401:1410'
            }
        );
    }
);

$(document).ready
(
    function()
    {
        $('.page-contact .form-contact-unit').select2
        ({
            language: "fa",
            dir: "rtl"
        });

        // map
        var lat = 35.731105;
        var lon = 51.436988;
        var zoom = 12;
        var txt = 'loca';

        var icon = L.icon
        ({
            iconUrl: 'assets/image/map-icon.png',
            popupAnchor: [0, -36],
            iconSize: [32, 32],
            iconAnchor: [12, 36]
        });

        var map = new L.Map
        (
            'map',
            {
                center: [lat, lon],
                zoom: zoom
            }
        );

        var center = L.marker([lat, lon], {icon: icon, draggable: 'true'}).addTo(map).bindPopup(txt);

        var baseMaps =
            {
                "OSM": new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
                "GMAP": new L.TileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', { subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] }),
                "GSAT": new L.TileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', { subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] })
            };

        center.getLatLng();
        baseMaps['GMAP'].addTo(map);
    }
);

$(document).ready
(
    function()
    {
        $('.page-blog .form-select').select2
        ({
            language: "fa",
            dir: "rtl"
        });
    }
);

$(document).ready
(
    function()
    {
        $('.page-profile-change-profile .form-select').select2
        ({
            language: "fa",
            dir: "rtl"
        });

        //
        $('.page-profile-change-profile .form-profile-legal-checkbox').change
        (
            function()
            {
                $('.page-profile-change-profile .legal-input-box').toggleClass('enable');
            }
        );
    }
);

$(document).ready
(
    function()
    {
        $('.page-profile-address .form-select').select2
        ({
            language: "fa",
            dir: "rtl"
        });

        //
        $(".page-profile-address .address-box").click
        (
            function()
            {
                $(".page-profile-address .address-box").removeClass("active");
                $(this).addClass("active");
            }
        );
    }
);

$(document).ready
(
    function()
    {
        $('.page-media .media-filter').select2
        ({
            language: "fa",
            dir: "rtl"
        });
    }
);

