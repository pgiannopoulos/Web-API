<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title> Ρύποι ΥΠΕΚΑ </title>
</head>
<body>


<?php
session_start();

if ((isset($_SESSION["admin"]) )&& ($_SESSION["admin"]==1)){

include 'includes/dbconnect.php';
$result1 = $mysqli->query("SELECT * FROM users" ) or die(mysql_error()); // Fernoume ola ta stoixeia twn users gia na diale3oume to API key tous kai ton ari8mo twn request tous pou katagrafontai sth vash sta antistoixa pedia tou table users

echo '<div id="divaki2">';

echo ' <table> <th> API Key </th> <th> Σταθμοί καταγραφής </th> <th> Απόλυτη τιμή ρύπανσης </th> <th> Μέση τιμή ρύπανσης</th>'; // Headers tou pinaka pou 8a deixnoume ta statistika
while($row = $result1->fetch_array()) {
   echo '<tr> '; 
   echo '<td>'; echo $row["API_key"]; echo '</td>';
   echo '<td>'; echo $row["station_request"]; echo '</td>';
   echo '<td>'; echo $row["abs_request"]; echo '</td>';
   echo '<td>'; echo $row["avg_request"]; echo '</td>';
	echo '</tr>';
}

//Emfanizoume me f8inousa seira ta 10 API keys me ta perissotera requests 
$result2 = $mysqli->query("SELECT API_key,station_request + abs_request + avg_request  as Sum from users ORDER BY Sum DESC LIMIT 10" ) or die(mysql_error());

echo ' <table> <th> API Key </th>  <th> Πλήθος αιτήσεων </th>';
while($row = $result2->fetch_array()) {
   echo '<tr> '; 
   echo '<td>'; echo $row["API_key"]; echo '</td>';
      echo '<td>'; echo $row["Sum"]; echo '</td>';

	echo '</tr>';
}

//Emfanizoume to plh8os twn API keys pou exoun dhmiourgh8ei 
$result3 = $mysqli->query("SELECT COUNT(API_key) AS count from users " ) or die(mysql_error());

echo ' <table> <th> Πλήθος API Keys </th>  ';
while($row = $result3->fetch_array()) {
   echo '<tr> '; 
   echo '<td>'; echo $row["count"]; echo '</td>';

	echo '</tr>';
}
echo '</div>';
}
?>


</body>
</html>
	