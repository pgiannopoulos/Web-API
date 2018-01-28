<!DOCTYPE html>
<html lang="en">

<head>
	<title>Testerino Siterino</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	<style>
		/* upsos grid tou navigation */
		.row.content {height: 760px;}
    
		/* gray fonto kai 100% height */
		.sidenav {
		background-color: #f1f1f1;
		height: 100%;
		}
    
		/* height auto gia mirkes o8ones */
		@media screen and (max-width: 767px) {
		.sidenav {
			height: auto;
			padding: 15px;
		}
		
		.row.content {height: auto;} 
		}
	
		#form_1{
			display:none;
			text-align:center;
		}
		select {
 
			margin: 8px;
			background: white;
			width: 200px;
			padding: 5px 35px 5px 5px;
			font-size: 16px;
			border: 1px solid;
			border-color: #c4c4c4 #d1d1d1 #d4d4d4;
			border-radius: 2px;
			outline: 5px solid #eff4f7;
			height: 34px;
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			background: url(includes/hi.png) 96% / 12% no-repeat white; 
		}
		input[type=text], input[type=password], input[type=email] {
			margin: 8px;
			padding: 0 10px;
			width: 200px;
			height: 34px;
			color: #404040;
			background: white;
			border: 1px solid;
			border-color: #c4c4c4 #d1d1d1 #d4d4d4;
			border-radius: 2px;
			outline: 5px solid #eff4f7;
			-moz-outline-radius: 3px;
			-webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
			box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
		}
		input[type=text]:focus, input[type=password]:focus {
			border-color: #7dc9e2;
			outline-color: #dceefc;
			outline-offset: 0;
		}
 
		input[type=submit] {
			padding: 0 18px;
			height: 29px;
			font-size: 12px;
			font-weight: bold;
			color: #527881;
			text-shadow: 0 1px #e3f1f1;
			background: #cde5ef;
			border: 1px solid;
			border-color: #b4ccce #b3c0c8 #9eb9c2;
			border-radius: 16px;
			outline: 0;
			-webkit-box-sizing: content-box;
			-moz-box-sizing: content-box;
			box-sizing: content-box;
			background-image: -webkit-linear-gradient(top, #edf5f8, #cde5ef);
			background-image: -moz-linear-gradient(top, #edf5f8, #cde5ef);
			background-image: -o-linear-gradient(top, #edf5f8, #cde5ef);
			background-image: linear-gradient(to bottom, #edf5f8, #cde5ef);
			-webkit-box-shadow: inset 0 1px white, 0 1px 2px rgba(0, 0, 0, 0.15);
			box-shadow: inset 0 1px white, 0 1px 2px rgba(0, 0, 0, 0.15);
		}
		input[type=submit]:hover {
	
			padding-right: 25px;
			font-size: 14px;
			cursor: pointer;
		}
		input[type=submit]:active {
			background: #cde5ef;
			border-color: #9eb9c2 #b3c0c8 #b4ccce;
			-webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
			box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
		}
		#form_2{
			display:none;
			text-align:center;
		}
	
		#map{ height: 100%; width :100%; margin-left:auto; margin-right:auto;}
	</style>
  
  
	<script
        src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=visualization"
        type="text/javascript">
	</script>
	
	

<script >
$(function(){
$('#abs_button').on('click', function changeText_Button_1() {
	document.getElementById("form_2").style.display = "none";
	document.getElementById("form_1").style.display = "block";
});
});
$(function(){
$('#avg_button').on('click', function changeText_Button_2() {
	document.getElementById("form_1").style.display = "none";
	document.getElementById("form_2").style.display = "block";
});
});
$(function(){
$('#std_button').on('click', function changeText_Button_3() {
	document.getElementById("form_1").style.display = "none";
	document.getElementById("form_2").style.display = "block";
});
});
	</script>
	<script>
		var map;
		var lati=[];
		var longi=[];
		var rupos = [];
		var Avg = [];
		var Dev = [];
		var json = "testing.txt";
		var jsonaki = "testing2.txt";
		var infowindow = new google.maps.InfoWindow();

		function initialize() {
$.get("http://localhost/return_stations_mysql.php");
			var mapProp = {
				center: new google.maps.LatLng(37.983917, 23.729360), //LLANDRINDOD WELLS
				zoom: 6,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};

			map = new google.maps.Map(document.getElementById("map"), mapProp);

			$.getJSON(json,function(json1) {
				var i=0;
				$.each(json1, function(key, data) {
					
					lati[i]= data.Latitude;
					longi[i]=data.Longitude;
					rupos[i]=data.rupos;
					Avg[i]=data.Avg;
					Dev[i]=data.Dev;
					i=i+1;
				});
				//alert(lati[1]);
			});
			$.getJSON(jsonaki,function(json2) {
			
				$.each(json2, function(key2, data2) {

					for (j = 0; j < lati.length; j++) {
						if (lati[j]==data2.Latitude && longi[j]==data2.Longitude){
							//alert (lati[j] + " " + longi[j] +" " + data2.Name);
							var latLng = new google.maps.LatLng(data2.Latitude, data2.Longitude);
							var marker = new google.maps.Marker({
								position: latLng,
								map: map,
							});
							if (rupos[j]==undefined) 
								var details = "Όνομα σταθμού: "+ data2.Name + "<br/>" + "Μέση τιμή: " +Avg[j] + "<br/>" + "Τυπική Απόκλιση: " +Dev[j];
							else
								var details = "Όνομα σταθμού: "+ data2.Name + "<br/>" + "Τιμή ρύπου: " +rupos[j];
					
					
							var infowindow = new google.maps.InfoWindow({
								content: details
							});
							
							marker.addListener('click', function() {
								infowindow.open(map, marker);
							});
						}
					}
 
				});
			});
		}

		function bindInfoWindow(marker, map, infowindow, strDescription) {
			google.maps.event.addListener(marker, 'click', function() {
				//infowindow.setContent(strDescription);
				infowindow.open(map, marker);
			});
		}
		google.maps.event.addDomListener(window, 'load', initialize);

	</script>
	
	<script 
		async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi5nYYhez-vA4oKcnZL3V2ir3AGeti4cY&callback=initialize" 
		type="text/javascript"> 
	</script>
</head>
<body>

	<div class="container-fluid" id="stage">
		<div class="row content">
			<div class="col-sm-3 sidenav">
				<h4>Διαθέσιμες Λειτουργίες</h4>
				<ul class="nav nav-pills nav-stacked">
					<li><button type="button" class="btn btn-primary btn-block" id="abs_button">Απόλυτη τιμή ρύπου</button></li>
					<li><button type="button" class="btn btn-primary btn-block" id="avg_button">Μέση τιμή ρύπου</button></li>
					<li><button type="button" class="btn btn-primary btn-block" id="std_button">Τυπική απόκλιση</button></li>
				</ul>
				
				<p><form  id="form_1" name="abs_form" method="post" action="http://localhost/return_abs_mysql2.php" enctype="multipart/form-data"> <br>
			<select required name="gas">
			<option disabled selected value> Διαλέξτε τύπο ρύπου </option>
			<option value="CO">CO</option>
			<option value="O3">O3</option>
			<option value="NO">NO</option>
			<option value="NO2">NO2</option>
			<option value="SO2">SO2</option>
			<option value="NOX">NOX</option>
			<option value="Smoke">Smoke</option>
			</select><br>
			<input type="text" name="station_code" placeholder="Κωδικός σταθμού" pattern=".{3,4}" title="3 to 4 characters or leave blank for all stations"><br> 
			<input type="text" name="date" placeholder="Ημ/νία σε μορφή DD-MM-YYYY" pattern=".{10}" required title="10 Characters"><br> 
			<input type="text" name="time" placeholder="Ώρα σε μορφή ΗΗ (24ωρη)" pattern=".{2}" required title="2 Digits"><br> 
			<input id="action" type="submit" value="Υποβολή"> 
			</form></p>
			
			
			
			<p><form id="form_2" name="abs_form" method="post" action="http://localhost/return_avg_mysql2.php" enctype="multipart/form-data"> <br>
			<select required name="gas" >
			<option value="first" disabled selected hidden style=" color: #333 ">Διαλέξτε τύπο ρύπου</option>
			<option value="CO">CO</option>
			<option value="O3">O3</option>
			<option value="NO">NO</option>
			<option value="NO2">NO2</option>
			<option value="SO2">SO2</option>
			<option value="NOX">NOX</option>
			<option value="Smoke">Smoke</option>
			</select><br>
			<input type="text" name="station_code" placeholder="Κωδικός σταθμού" pattern=".{3,4}" title="3 to 4 characters or leave blank for all stations"><br> 
			<input type="text" name="duration" placeholder="Χρονικό Διάστημα" pattern=".{4,10}" required title="YYYY or MM-YYYY or DD-MM-YYYY"><br> 
			<input id="action" type="submit" value="Υποβολή"> 
			</form></p>
			
			</div>
			<div class="col-sm-9">
				<h4><small>Χάρτης Δεδομένων</small></h4>
				<div id="map" style="width:700px;height:600px;"></div> 
			</div>
     
		</div>
	</div>

</body>
</html>


