/**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
let map;

function initMap() {
    var styles = [
        {
            "featureType": "administrative",
            "elementType": "geometry",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "poi",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "transit",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        }
    ];

    map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(39.132176042861374, 35.397435913092195),
        zoom: 12,
        disableDefaultUI: true,
        scrollwheel: true,
        gestureHandling: 'greedy',
        mapId: 'a64894061973938a'
    });

    map.setOptions({ styles: styles });


    const infowindow = new google.maps.InfoWindow({
        ariaLabel: "Uluru",
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                map.setCenter(pos);
                $('body').loadingModal('destroy');
                map.setZoom(10);
            },
            () => {
                handleLocationError(true, infowindow, map.getCenter());
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infowindow, map.getCenter());
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation ?
                "Error: The Geolocation service failed." :
                "Error: Your browser doesn't support geolocation."
        );
        infoWindow.open(map);
    }


    var styles = [
        {
            featureType: "landscape.man_made",
            elementType: "geometry",
            stylers: [
                {visibility: "on"},
                {color: "#d4ebf4"}
            ]
        },
        {
            featureType: "road",
            elementType: "labels.text.fill",
            stylers: [
                {visibility: "on"},
                {color: "#202020"}
            ]
        },
        {
            featureType: "poi.business",
            elementType: "all",
            stylers: [
                {visibility: "on"}
            ]
        },
        {
            featureType: "poi.park",
            elementType: "all",
            stylers: [
                {color: "#98d1e8"}
            ]
        },
        {
            featureType: "poi.school",
            elementType: "all",
            stylers: [
                {visibility: "off"},
                {color: "#808080"}
            ]
        },
        {
            featureType: "all",
            elementType: "geometry.stroke",
            stylers: [
                {visibility: "off"}
            ]
        },
        {
            featureType: "poi.park",
            elementType: "labels.text.fill",
            stylers: [
                {visibility: "off"}
            ]
        },
        {
            featureType: "transit.station.rail",
            elementType: "labels.icon",
            stylers: [
                {hue: "#005eff"},
                {saturation: -37}
            ]
        },
        {
            featureType: "poi.park",
            elementType: "labels.text.stroke",
            stylers: [
                {color: "#808080"}
            ]
        },
        {
            featureType: "road.local",
            elementType: "all",
            stylers: [
                {color: "#ffffff"}
            ]
        },
        {
            featureType: "all",
            elementType: "labels.text.fill",
            stylers: [
                {color: "#808080"}
            ]
        },
        {
            featureType: "transit.line",
            elementType: "all",
            stylers: [
                {color: "#ffffff"}
            ]
        }
    ];

    map.setOptions({styles: styles});

    /** Markers **/
    const priceIcon = document.createElement("div");
    priceIcon.className = "marker";
    priceIcon.innerHTML = '<img src="../assets/images/icons/boat.svg"/>';

    const markerIcon = new google.maps.marker.AdvancedMarkerView({
        map,
        position: {lat: 40.975125, lng: 29.050932},
        content: priceIcon,
    });
    google.maps.event.addListener(markerIcon, 'click', (e) => {
        map.setZoom(16);
        map.panTo(new google.maps.LatLng(40.975125 - 0.0035, 29.050932));
        modal_show();
    });

// Click Event
    $(document).on('click', '.item', function () {
        let _id = $(this).attr("data-activity-id");
        const data = _markers[_id];
        map.setZoom(map.getZoom() - 3);
        setTimeout(() => {
            map.panTo(new google.maps.LatLng(data.lat - 0.0035, data.lng));
            map.setZoom(15);
        }, 800);
    });

    function modal_show(data) {
        $('#activity-detail').modal('toggle');
    }


    const konum = new google.maps.Marker({
        icon: {
            url: '../assets/images/icons/blue-circle.svg',
            size: new google.maps.Size(100, 100),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(50, 50),
            scaledSize: new google.maps.Size(100, 100)
        },
        draggable: false,
        map: map,
    });

    /* Watch Position */
    let id;
    let target;
    let options;

    function success(pos) {
        const crd = pos.coords;
        if (target.latitude === crd.latitude && target.longitude === crd.longitude) {
            console.log('Congratulations, you reached the target');
            navigator.geolocation.clearWatch(id);
        }
        changeMarkerPosition(pos);
    }


    function changeMarkerPosition(pos) {
        var latlng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
        konum.setPosition(latlng);
        console.log("Position Get");
        localStorage.setItem('latitude', pos.coords.latitude);
        localStorage.setItem('longitude', pos.coords.longitude);
    }

    function error(err) {
        console.error(`ERROR(${err.code}): ${err.message}`);
    }

    target = {
        latitude: 0,
        longitude: 0
    };

    options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
    };

// Start : Konum Bul Button
    $(document).on('click', '.compass > button', () => {
        let lat = localStorage.getItem('latitude');
        let lng = localStorage.getItem('longitude');
        map.panTo(new google.maps.LatLng(lat, lng));
    });

    id = navigator.geolocation.watchPosition(success, error, options);

    $(document).on('click', '.--rez-modal .close', () => {
        $(".--rez-modal").css({top: '850px'});
    });

}

window.initMap = initMap;

/*
* Harita sayfasındaki takvim
*/
let options = $.extend({},
    $.datepicker.regional["tr"], {
        minDate: 0,
        minDate: 0,
        beforeShowDay: function(date) {
            var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#first-date").val());
            var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#second-date").val());
            return [true, date1 && ((date.getTime() == date1.getTime()) || (date2 && date >= date1 && date <= date2)) ? "dp-highlight" : ""];
        },
        onSelect: function(dateText, inst) {
            var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#first-date").val());
            var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#second-date").val());
            var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);


            if (!date1 || date2) {
                $("#first-date").val(dateText);
                $("#second-date").val("");
                $(this).datepicker();
            } else if( selectedDate < date1 ) {
                $("#second-date").val( $("#first-date").val() );
                $("#first-date").val( dateText );
                $(this).datepicker();
            } else {
                $("#second-date").val(dateText);
                $(this).datepicker();
            }
        }
    }
);

$("#filter-calendar").datepicker(options);

// Filtre ayarları
const filter_options = {
    api_url: api_url,
    price:
        {
            min: min_price, // Tedarikçiden gelen aktivitelerde en düşük olan satış fiyatı
            max: max_price, // Tedarikçiden gelen aktivitelerde en yüksek olan satış fiyat
        },
};

var paddingSlider = document.getElementById('slider-pricing');
noUiSlider.create(paddingSlider, {
    start: [filter_options.price.min, filter_options.price.max],
    range: {
        'min': filter_options.price.min,
        'max': filter_options.price.max
    },
    format: wNumb({
        decimals: 3,
        thousand: '.',
        prefix: '₺ '
    })
});

const paddingMin = document.getElementById('slider-pricing-value-min');
const paddingMax = document.getElementById('slider-pricing-value-max');
paddingSlider.noUiSlider.on('update', function (values, handle) {
    if (handle) {
        paddingMax.innerHTML = values[handle];
    } else {
        paddingMin.innerHTML = values[handle];
    }
});

new Swiper(".activities", {
    pagination: {
        el: ".swiper-pagination-dynamic",
        dynamicBullets: true,
    },
});

new Swiper(".activity-detail-slider", {
    autoplay: true,
    pagination: {
        el: ".swiper-pagination-dynamic",
        dynamicBullets: true,
    },
});

$('#toggle-view').click(function () {
    if (!$('#map').hasClass('d-none')) {
        $('#list').removeClass('d-none')
        $('#map').addClass('d-none')
        $(this).html(`<i class="fa-solid fa-map"></i> ${map_button_map_view_text}`)
    } else {
        $('#map').removeClass('d-none')
        $('#list').addClass('d-none')
        $(this).html(`<i class="fa-solid fa-list"></i> ${map_button_list_view_text}`)
    }
})

// Start : Filtre butonu işlemi
$("form#filter-form").submit(function (e) {
    e.preventDefault();
    const regex = /\d+/g; // Sadece rakamları al

    // Filtre için gönderilecek parametreler
    const first_date = $("#first-date");
    const second_date = $("#second-date");
    const adult_count = $("#adult_count");
    const child_count = $("#child_count");
    const infant_count = $("#child_count");
    const min_price = $("#slider-pricing-value-min");
    const max_price = $("#slider-pricing-value-max");

    const data = {
        "dates": {
            "first_date": first_date.val(),
            "second_date": second_date.val(),
        },
        "adult": adult_count.val(),
        "child": child_count.val(),
        "infant": infant_count.val(),
        "price": {
            "min": min_price.text().match(regex)[0],
            "max": max_price.text().match(regex)[0], // Servisten gelecek
        },
        "currency": currency
    };

    // Eğer başlangıç tarihi seçilmezse.
    if (data.dates.first_date === "") {
        f
        return false;
    }

    // Kullanıcı satın alacak kişi sayısı seçmezse
    if (adult_count.val() == 0 && child_count.val() == 0 && infant_count.val() == 0) {
        swal({
            title: warning,
            text: enter_number_of_people,
            type: "warning",
            confirmButtonText: text_ok,
            confirmButtonClass: 'btn btn-lg btn-primary',
        });
        return false;
    }

    // Fiyatın sadece INTEGER değerini al
    let min = $(paddingMin).text().match(regex);

    // Fiyatın sadece INTEGER değerini al
    let max = $(paddingMax).text().match(regex);
});