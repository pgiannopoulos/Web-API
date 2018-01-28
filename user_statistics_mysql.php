
<?php
session_start();
//var_dump($_POST);
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title> Ρύποι ΥΠΕΚΑ </title>
</head>
<body>


<?php
$api_key = $_SESSION['api_key'];
include 'includes/dbconnect.php';
$result1 = $mysqli->query("SELECT * FROM users WHERE API_key LIKE '$api_key' " ) or die(mysql_error()); // Fernoume ola ta stoixeia tou user gia na diale3oume to API key tou kai ton ari8mo twn request tou pou katagrafontai sth vash sta antistoixa pedia tou table users
echo '<div id="divaki2">';
echo ' <table> <th> API Key </th> <th> Σταθμοί καταγραφής </th> <th> Απόλυτη τιμή ρύπανσης </th> <th> Μέση τιμή ρύπανσης</th>';
while($row = $result1->fetch_array()) { // emfanizoume ta requests tou xrhsth gia ka8e kathgoria
   echo '<tr> '; 
   echo '<td>'; echo $row["API_key"]; echo '</td>';
   echo '<td>'; echo $row["station_request"]; echo '</td>';
   echo '<td>'; echo $row["abs_request"]; echo '</td>';
   echo '<td>'; echo $row["avg_request"]; echo '</td>';
	echo '</tr>';
}


echo '</div>';
?>


</body>
</html>
	