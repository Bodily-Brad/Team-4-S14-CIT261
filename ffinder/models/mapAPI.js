/***********************
GOOGE PLACES API CODE
************************/
function googleMap(foodkind){
    var map, placesList;

    // detecting user location
    navigator.geolocation.getCurrentPosition(initialize);

    function initialize(position) {
        var la = position.coords.latitude;
        var lo = position.coords.longitude;
        var slc = new google.maps.LatLng(la, lo);
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: slc,
            zoom: 8
        });

        // here our food suggestion should replace the value of KEYWORD in this object
        var request = {
            location: slc,
            radius: 1500,
            types: ['restaurant'],
            keyword: 'pizza'
        };
        
        request.keyword = foodkind;
        
        placesList = document.getElementById('places');
        
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, callback);
    }

    function callback(results, status, pagination) {
        if (status != google.maps.places.PlacesServiceStatus.OK) {
            return;
        } else {
            createMarkers(results);

            if (pagination.hasNextPage) {
                var moreButton = document.getElementById('more');

                moreButton.disabled = false;

                google.maps.event.addDomListenerOnce(
                    moreButton,
                    'click',
                    function () {
                        moreButton.disabled = true;
                        pagination.nextPage();
                    }
                );
            }
        }
    }

    function createMarkers(places) {
        var bounds = new google.maps.LatLngBounds();

        for (var i = 0, place; place = places[i]; i++) {
            var image = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            var marker = new google.maps.Marker({
                map: map,
                icon: image,
                title: place.name,
                position: place.geometry.location
            });

            placesList.innerHTML += '<li>' + place.name + '</li>';

            bounds.extend(place.geometry.location);
        }
        map.fitBounds(bounds);
    }

    //google.maps.event.addDomListener(window, 'load', initialize);
};

/***********************
JQUERY CODE HERE
************************/
$(document).ready(function () {
    // moved button listeners to foodfinder.js as distinct functions

/***********************
JAVASCRIPT WORKERS CODE
************************/
                    
    var clock;

    function clockWorker() {
         if (typeof (Worker) !== "undefined") {
              if (typeof (clock) == "undefined") {
                   clock = new Worker("worker.js");
              }
              clock.onmessage = function (event) {
                   document.getElementById("result").innerHTML = event.data;
              };
         } else {
              alert("Your browser doesn't support web workers. Try using the latest version of Google Chrome.");
         }
    }

    function stopWorker() {
         w.terminate();
    }

    clockWorker();
});