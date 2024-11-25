let map;

async function initMap() {
    let marker;
    let lat;
    let lng;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            startPos = position;
            lat = startPos.coords.latitude;
            lng = startPos.coords.longitude;
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                draggable: true,
                map: map
            });

            $("[name='latitude']").val(startPos.coords.latitude);
            $("[name='longitude']").val(startPos.coords.longitude);

            google.maps.event.addListener(marker, 'drag', function (event) {
                $("[name='latitude']").val(event.latLng.lat());
                $("[name='longitude']").val(event.latLng.lng());
            });
        }, function (error) {
            alert("Error occurred. Error code: " + error.code);
        });
    }
    const { Map } = await google.maps.importLibrary("maps");
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(39, 35)
    });
}
initMap();