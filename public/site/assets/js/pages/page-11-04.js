$(document).ready
(
    function()
    {
        // date
        $(".form-input-date").datepicker
        (
            {
                dateFormat: 'yy/mm/dd',
                yearRange: '1401:1410'
            }
        ).parent().click
        (
            function()
            {
                $(this).find("input").focus();
            }
        );

        //
        $('.page-profile-change-profile .form-profile-legal-checkbox').change
        (
            function()
            {
                $('.page-profile-change-profile .input-box-disabled-enable').toggleClass('enable');
                $(".page-profile-change-profile .form-profile-legal-province, .page-profile-change-profile .form-profile-legal-city").prop("disabled", !$(".page-profile-change-profile .form-profile-legal-province, .page-profile-change-profile .form-profile-legal-city").prop("disabled"));
            }
        );
    }
);
