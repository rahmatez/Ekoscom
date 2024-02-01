<!DOCTYPE html>
<html>

<head>
    <style>
    /* Set the size of the div element that contains the map */
    #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
    </style>
</head>

<body>
    <h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
    <div id="map"></div>
    <script>
    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        var uluru = {
            lat: -2.08,
            lng: 133.68
        };
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {
                zoom: 15,
                center: uluru
            });
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({
            position: uluru,

            map: map
        });
    }
    </script>
    <!--Load the API from the specified URL
	* The async attribute allows the browser to render the page while the API loads
	* The key parameter will contain your own API key (which is not needed for this tutorial)
	* The callback parameter executes the initMap() function
	-->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVnM2aB8EJUic7EgPgzJQvup0A-VPjp7E&callback=initMap">
    </script>
</body>


</html>