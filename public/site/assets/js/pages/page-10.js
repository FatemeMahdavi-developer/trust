$(document).ready
(
    function()
    {
        $('.page-faq .container-faq .question').click
        (
            function()
            {
                if(!$(this).parent().hasClass('open'))
                {
                    $('.page-faq .container-faq .faq-item.open .answer').slideUp();
                    $('.page-faq .container-faq .faq-item.open').removeClass('open');
                }

                $(this).parent().toggleClass('open');
                $(this).next().slideToggle();
            }
        );
    }
);
