$(document).ready
(
    function()
    {
        // scroll
        if(window.location.hash !== '') $('html,body').animate({scrollTop: $(window.location.hash).offset().top}, 'slow');

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
    }
);
