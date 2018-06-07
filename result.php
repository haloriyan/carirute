<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>hai</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
<div id="mapsResult" class="maps" style="z-index: 12;"></div>
<input type="hidden" id="mulai" value="<?php echo $_COOKIE['berangkat']; ?>">
<input type="hidden" id="akhir" value="<?php echo $_COOKIE['tujuan']; ?>">
<script>
	function initMap() {
		var directionsService = new google.maps.DirectionsService
		var directionsDisplay = new google.maps.DirectionsRenderer
		var map = new google.maps.Map(document.getElementById('mapsResult'), {
			zoom: 7,
			center: {lat: 41.85, lng: -87.65}
		})
		directionsDisplay.setMap(map)

		calculateAndDisplayRoute(directionsService, directionsDisplay)
	}

	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
		var mulai = document.getElementById('mulai').value
		var akhir = document.getElementById('akhir').value

		directionsService.route({
			origin: mulai,
			destination: akhir,
			travelMode: 'DRIVING'
		}, function(response, status) {
			if(status === "OK") {
				directionsDisplay.setDirections(response)
			}else {
				alert("error")
			}
		})
	}
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>	
</body>
</html>