

<script>
    // Send location in background
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function(position) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("POST", "locationup.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("latitude=" + position.coords.latitude + "&longitude=" + position.coords.longitude);
        }, function() {
            console.log("Error: Could not get location");
        }, {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0,
            distanceFilter: 10
        });
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
</script>

