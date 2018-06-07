<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Antinyasar</title>
	<script src="inc/jquery-3.1.1.js"></script>
	<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDqYJGuWw9nfoyPG8d9L1uhm392uETE-mA'></script>
	<script src="inc/locationpicker.jquery.min.js"></script>
	<link href="style.css" rel="stylesheet">
</head>
<body>

<div id="berangkat" class="bagian">
	<div id="mapsBerangkat" class="maps"></div>
	<div class="pencarian">
		<input type="text" class="box" id="alamatBerangkat">
		<input type="hidden" id="latBerangkat">
		<input type="hidden" id="lngBerangkat">
	</div>
	<div class="cta">
		<button id="setBarangkat">NEXT</button>
	</div>
</div>

<div id="tujuan" class="bagian" style="display: none;">
	<div id="mapsTujuan" class="maps"></div>
	<div class="pencarian">
		<input type="text" class="box" id="alamatTujuan">
		<input type="hidden" id="latTujuan">
		<input type="hidden" id="lngTujuan">
	</div>
	<div class="cta">
		<button id="setTujuan">ROUTE</button>
	</div>
</div>

<div id="result" class="bagian" style="display: none;"></div>

<script>
	$(function() {
		$("#mapsBerangkat").locationpicker({
            location: {
            	latitude: -7.265102600000001,
            	longitude: 112.74500009999997
            },
            radius: 0,
            inputBinding: {
            	latitudeInput: $("#latBerangkat"),
            	longitudeInput: $("#lngBerangkat"),
            	locationNameInput: $('#alamatBerangkat')
            },
            enableAutocomplete: true,
            onchanged: function() {
            	//
            }
		})
		$("#mapsTujuan").locationpicker({
            location: {
            	latitude: -7.265102600000001,
            	longitude: 112.74500009999997
            },
            radius: 0,
            inputBinding: {
            	latitudeInput: $("#latTujuan"),
            	longitudeInput: $("#lngTujuan"),
            	locationNameInput: $('#alamatTujuan')
            },
            enableAutocomplete: true,
            onchanged: function() {
            	//
            }
		})

		$("#setBarangkat").click(function() {
			let latBerangkat = $("#latBerangkat").val()
			let lngBerangkat = $("#lngBerangkat").val()
			let coords = latBerangkat + ", " + lngBerangkat
			let set = "namakuki=berangkat&value="+coords+"&durasi=3665"
			$.ajax({
				type: "POST",
				url: "setCookie.php",
				data: set,
				success: function() {
					$("#berangkat").hide()
					$("#tujuan").show()
				}
			})
		})

		$("#setTujuan").click(function() {
			let latBerangkat = $("#latTujuan").val()
			let lngBerangkat = $("#lngTujuan").val()
			let coords = latBerangkat + ", " + lngBerangkat
			let set = "namakuki=tujuan&value="+coords+"&durasi=3665"
			$.ajax({
				type: "POST",
				url: "setCookie.php",
				data: set,
				success: function() {
					$("#tujuan").hide()
					$("#result").show()
					$.get("result.php", function(res) {
						$("#result").html(res)
					})
				}
			})
		})
	})
</script>

</body>
</html>