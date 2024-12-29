$(document).ready
(
    function()
    {
        //
        $(".page-reseller .reseller-data-box").mCustomScrollbar();

        // map
        $('#IranMap .map .province path').hover
        (
            function()
            {
                var c = $(this).attr("title");

                $("#IranMap .show-title").html(c).css({display: "block"});
            },
            function()
            {
                $("#IranMap .show-title").html("").css({display: "none"});
            }
        );

        $('#IranMap .map .province path').click
        (
            function()
            {
                var provinceName = $(this).attr("id");
                var provinceId = $('#IranMap .list li.' + provinceName + ' a').attr('data-ostan');

                if(provinceId)
                {
                    location.href += '?kind=1&ostan=' + provinceId;
                }
            }
        );

        $("#IranMap").mousemove
        (
            function(d)
            {
                var c = 0;
                var h = 0;

                if (!d)
                {
                    d = window.event;
                }

                if (d.pageX || d.pageY)
                {
                    c = d.pageX;
                    h = d.pageY;
                }
                else
                {
                    if (d.clientX || d.clientY)
                    {
                        c = d.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
                        h = d.clientY + document.body.scrollTop + document.documentElement.scrollTop;
                    }
                }

                if ($("#IranMap .show-title").html())
                {
                    var f = $(this).offset();
                    var b = (c - f.left + 25) + "px";
                    var g = (h - f.top - 5) + "px";
                    $("#IranMap .show-title").css({left: b, top: g});
                }
            }
        );
    }
);
