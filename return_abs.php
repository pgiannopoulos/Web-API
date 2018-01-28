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
$mysqli->query("UPDATE users SET abs_request=abs_request+1 WHERE API_key ='$key' " )or die(mysql_error());  // metrame to request 
$_SESSION['code'] = $_POST['station_code']; // xrhsimopoioume thn global metavlhth SESSION ka8ws 8eloume n perasoume dedomena apo th forma se 2 arxeia kai h POST den exei tetoio scope
$_SESSION['hour'] = $_POST['time'];
$_SESSION['date'] = $_POST['date'];
$_SESSION['gas'] = $_POST['gas'];

if (isset($_SESSION["admin"]) ){ // den elegxoume an einai admin h user, apla an uparxei energo session , afou ta dedomena einai prosvasima kai stous 2

// Dhmiourgoume ton pinaka pou 8a periexei ta stoixeia pou travame apo to JSON, mesw enos XMLHttpRequest
echo '	
<div id="divaki1"> </div>

<script>
var xmlhttp = new XMLHttpRequest();
var url = "return_abs_mysql.php";

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
        "Γεωγραφικό πλάτος" +
        "</th><th>" +
        "Γεωγραφικό μήκος" +
        "</th><th>" +
        "Τιμή ρύπου" +
        "</th><th>" 
		
    for(i = 0; i < arr.length; i++) {
        out += "<tr><td>" + 
        arr[i].Latitude +
        "</td><td>" +
        arr[i].Longitude +
        "</td><td>" +
        arr[i].rupos +
        "</td><td>" ;
		
    }
    out += "</table>";
    document.getElementById("divaki1").innerHTML = out;
}
</script>

';
if ($_SESSION["admin"]==1){ // an einai admin epistrofh sto menu tou admin
	echo '
	<form id="menu-button" action="admin_index.php" method="get">
	<input type="submit" value="Επιστροφή στο μενού" name="Submit" />
	</form>
	';
}else { // an einai user epistrofh sto menu tou user
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
}else {
	echo ' <div class="message-box">Παρακαλώ συνδεθείτε για να δείτε το περιεχόμενο</div>';
}


?>
</body>
</html>	