<style>
    #map_wrapper {height: 500px;}
    #map{width: 100%;height: 500px;}
</style>
<div class="row">
    <div class="col-lg-12 col-md-10 mx-auto">
        <h2 class="post-title">
            ABOUT SEABOM'S BLOG
        </h2>
        <div class="post-subtitle">
            <p>안녕<br>안녕<br>안녕</p>
        </div>
    </div>
    <div class="col-lg-12 col-md-10 mx-auto">
        <h2 class="post-title">
            WHERE I HAVE BEEN!!
        </h2>
        <div id="map_wrapper" class="mt40">
            <div id="map" class="mapping"></div>
        </div>
    </div>
</div>

<script>
    jQuery(function($) {
    // Asynchronously Load the map API
        var script = document.createElement('script');
        script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyBDz4V-eTA2s97tx4CGI8cTTAoN3q5tCHA&language=en&callback=initMap";
        document.body.appendChild(script);
    });
    // doctype html5 선언시 구글 api 작동 오류로 height 안 잡히는 현상 해결
    function mapResize(){
        if(matchMedia("screen and (max-width: 414px)").matches) {
            $('#map').css({'height': '100%'});
        } else if(matchMedia("screen and (max-width: 1024px)").matches) {
            $('#map').css({'height': '100%'});
        } else{
            $('#map').css({'height': '100%'});
        }
    };
    mapResize();
    function initMap() {
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap',
            center: {lat: 37.475678, lng: 126.881719},
            styles: [
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#a0d6d1"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#dedede"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#dedede"
                        },
                        {
                            "lightness": 29
                        },
                        {
                            "weight": 0.2
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#dedede"
                        },
                        {
                            "lightness": 18
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f1f1f1"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "saturation": 36
                        },
                        {
                            "color": "#333333"
                        },
                        {
                            "lightness": 40
                        }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        },
                        {
                            "lightness": 19
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 17
                        },
                        {
                            "weight": 1.2
                        }
                    ]
                }
            ]

        };
// Display a map on the page
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        map.setTilt(45);

// Multiple Markers
        var markers = [
            <?php
            for($i = 0; $i < count($been_list); $i++){
            ?>
            ['<?php echo $been_list[$i]['city'].','.$been_list[$i]['country'];?>', <?php echo $been_list[$i]['latitude'];?>,<?php echo $been_list[$i]['longitude'];?>],
            <?php }?>
        ];

// Info Window Content
        var infoWindowContent = [
            <?php
            for($i = 0; $i < count($been_list); $i++){
            ?>
            ['<div class="info_content">' +
            '<h3><?PHP echo $been_list[$i]["city"].",".$been_list[$i]["country"];?></h3>' +
            '<p><?PHP echo $been_list[$i]["content"]?></p>' +
            '</div>'],
            <?php }?>
        ];

// Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow(), marker, i;

// Loop through our array of markers & place each one on the map
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            var iconBase = 'img/marker/16x16/';//아이콘 변경 1/2
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0],
                icon: iconBase + 'marker-'+ i +'.png',//아이콘 변경 2/2
                animation: google.maps.Animation.BOUNCE //아이콘 바운스 애니메이션 추가
            });

// 마커 바운스 애니메이션 추가

// Allow each marker to have an info window
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

// Automatically center the map fitting all markers on the screen
            map.fitBounds(bounds);

        }
// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(2);
            google.maps.event.removeListener(boundsListener);
        });
// 특정 지역에다른 색상 입히기
    }
</script>