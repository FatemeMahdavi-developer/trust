
<script type="text/javascript" src="{{asset('site/assets/js/libs/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/jquery.typewatch.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/dotimeout.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/mCustomScrollbar.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/select2-fa.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/lightgallery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/lg-zoom.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/lg-thumbnail.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/persianumber.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/datepicker-fa.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/plugin/raty/jquery.raty.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/libs/plugin/raty/javascript.raty.js')}}"></script>
<script type="text/javascript" src="{{asset('site/assets/js/main.js')}}"></script>
<script type="text/javascript" src="{{asset("site/assets/js/sweetalert.js")}}"></script>
<link rel="stylesheet" href="{{asset("site/assets/leaflet/leaflet.css")}}" />
<script src="{{asset("site/assets/leaflet/leaflet.js")}}"></script>

<script>
    $("#search_string").on('submit', function() {
        action = $(this).attr('action');
        value = $('#search_string input').val();
        var valuereplaced = value.replace(/\s+/g, "+");
        if ($("#search_string input").val().length > 1) {
            window.location = action + '?keyword=' + valuereplaced;
        }
        return false;
    });
    var options = {
        callback: function (value) { 
            showsearch(value);
        },
        wait: 750,
        highlight: true,
        allowSubmit: false,
        captureLength: 0
    }
    $(document).ready(function() {
        $(".search__input").typeWatch( options );
    });
    var xhr;
    function showsearch(elm) {
        var count = elm.length;
        if (count > 1) {
            if(xhr && xhr.readyState != 4){
                xhr.abort();
            }
            var elmreplaced = elm.replace(/\s+/g,"+");
            $.ajaxSetup({
            headers:
                {'X-CSRF-TOKEN': "{{csrf_token()}}"  }
            });
            xhr = $.ajax({
                type: "POST",
                url:'{{route("search")}}'+'?keyword='+encodeURIComponent(elmreplaced),
                success: function(data) {            
                    $(".advanced_search").html(data).fadeIn();
                }
            });
            return false;
        } else {
            $('.advanced_search').slideUp(500);
        }
    }
    $(".advanced_search").click(function(e) {
        e.stopPropagation(e);
    });
</script>