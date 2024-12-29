<!-- General JS Scripts -->
<script src="{{asset("admin/assets/js/app.min.js")}}"></script>
<script src="{{asset("admin/assets/boundles/summernote/summernote-bs4.js")}}"></script>
<script src="{{asset("admin/assets/js/tagsinput.js")}}"></script>
<script src="{{asset("admin/assets/boundles/select2/dist/js/select2.full.min.js")}}"></script>
<script src="{{asset("admin/assets/js/page/sweetalert.js")}}"></script>

<script src="{{asset("admin/assets/js/scripts.js")}}"></script>

<link rel="stylesheet" href="{{asset("admin/assets/leaflet/leaflet.css")}}" />
<script src="{{asset("admin/assets/leaflet/leaflet.js")}}"></script>

<script>
    function location_map($lat='',$lng='',$text='',$zoom='19'){
        var map = L.map('map').setView([$lat,$lng],$zoom);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            // attribution:'&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([$lat,$lng]).addTo(map);

        if($text!=''){
            marker.bindPopup($text).openPopup();
        }


        // var circle = L.circle([35.688216300659526,51.28145344371738], {
        //     color: 'red',
        //     fillColor: '#ddd',
        //     fillOpacity: 0.5,
        //     radius: 100
        // }).addTo(map);
        // circle.bindPopup("<b>I am a circle</b>").openPopup();

        // var polygon = L.polygon([
        //     [35.64985843848322,51.339282951144185],
        //     [35.688216300659526,51.28145344371738],
        //     [35.56815883281119, 51.21373760390884]
        // ]).addTo(map);
        // polygon.bindPopup("I am a polygon.");

        function onMapClick(e) {
            $(".lgmap").find("input").val(e.latlng.lng);
            $(".qgmap").find("input").val(e.latlng.lat);
        }
        map.on('click', onMapClick);
    }
</script>

<script>
    var messages=@json(__("common.msg"));
</script>
<script src="{{asset("admin/assets/js/custom.js")}}"></script>
