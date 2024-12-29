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
        var txt = 'Cotton';

        var icon = L.icon
        ({
            iconUrl: 'assets/image/icon-map.png',
            popupAnchor: [0, -36],
            iconSize: [32, 45],
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
