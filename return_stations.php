<?php
session_start();
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title> Ρύποι ΥΠΕΚΑ </title>
</head>
<body>

<?php

include 'includes/dbconnect.php';
$key = $_SESSION['api_key']; 
$mysqli->query("UPDATE users SET station_request=station_request+1 WHERE API_key ='$key' " )or die(mysql_error()); //metrame to request

if (isset($_SESSION["admin"]) ){
// Dhmiourgoume ton pinaka pou 8a periexei ta stoixeia pou travame apo to JSON, mesw enos XMLHttpRequest

echo '	
<div id="divaki1"> </div>

<script>
var xmlhttp = new XMLHttpRequest();
var url = "return_stations_mysql.php";

xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        myFunction(xmlhttp.responseText);
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send();

function myFunction(response) {
    var arr = JSON.parse(response);
    var i;
    var out = "<table>";

	out += "<tr><th>" + 
        "Όνομα σταθμού" +
        "</th><th>" +
        "Κωδικός σταθμού" +
        "</th><th>" +
        "Γεωγραφικό πλάτος" +
        "</th><th>" +
		"Γεωγραφικό μήκος" +
        "</th></th>";
		
    for(i = 0; i < arr.length; i++) {
        out += "<tr><td>" + 
        arr[i].Name +
        "</td><td>" +
        arr[i].Code +
        "</td><td>" +
        arr[i].Latitude +
        "</td><td>" +
		arr[i].Longitude +
        "</td></tr>";
    }
    out += "</table>";
    document.getElementById("divaki1").innerHTML = out;
}
</script>

';
if ($_SESSION["admin"]==1){
	echo '
	<form id="menu-button" action="admin_index.php" method="get">
	<input type="submit" value="Επιστροφή στο μενού" name="Submit" />
	</form>
	';
}else {
	echo '
	<form id="menu-button" action="user_index.php" method="get">
	<input type="submit" value="Επιστροφή στο μενού" name="Submit" />
	</form>
	';
}
	echo '
	<form id="logout-button" action="logout.php" method="get">
	<input type="submit" value="Αποσύνδεση" name="Submit"  />
	</form>
	';
}
else {
	echo ' <div class="message-box">Παρακαλώ συνδεθείτε για να δείτε αυτό το περιεχόμενο!</div>';
}
?>

</body>
</html>


