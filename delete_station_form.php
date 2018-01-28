<?php
		session_start();
		//var_dump($_SESSION);


?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title> Ρύποι ΥΠΕΚΑ </title>
</head>
<body>
<?php
if ((isset($_SESSION["admin"]) )&& ($_SESSION["admin"]==1)){

	include 'includes/dbconnect.php';
	
	$result = $mysqli->query(" SELECT name FROM stations ")or die(mysql_error()); // Pairnoume ta onomata sta8mwn apo th vash gia na ftia3oume to dropdown

	echo "<h1>Δηλώστε τα στοιχεία του σταθμού που θέλετε να διαγράψετε: </h1><br>";
	
	echo'<form name="delete_station" method="post" action="delete_station.php">
	<select required name="station_select_form">	<option disabled selected value> Διαλέξτε όνομα σταθμού </option>';
	while($row = $result->fetch_array())
	{
		echo '<option value="'; echo $row['name']; echo '"> '; echo $row['name']; echo ' </option>';// Ta emfanizoume sto dropdown
	}
	echo '</select><br>';
	echo '<input id="action" type="submit" value="Διαγραφή"/>
		</form> ';
		
	echo '
	<form id="menu-button" action="admin_index.php" method="get">
	<input type="submit" value="Επιστροφή στο μενού" name="Submit" />
	</form>
	';
	echo '
	<form id="logout-button" action="logout.php" method="get">
	<input type="submit" value="Αποσύνδεση" name="Submit"  />
	</form>
	';
}
else {
	echo ' <div class="message-box">Παρακαλώ συνδεθείτε ως διαχειριστής για να δείτε αυτό το περιεχόμενο!</div>';
}


?>
</body>
</html>