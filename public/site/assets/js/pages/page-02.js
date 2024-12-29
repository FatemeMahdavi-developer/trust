$(document).ready
(
    function()
    {
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
