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
if ((isset($_SESSION["admin"]) )&& ($_SESSION["admin"]==1)){

	include 'includes/dbconnect.php';
	$station_name = $_POST["station_name"]; // Pername ta dedomena apo th forma se topikes metavlhtes gia pio eukolo xeirismo
	$station_code = $_POST["station_code"];
	$station_latitude = $_POST["station_latitude"];
	$station_longitude = $_POST["station_longitude"];

	// Dhmiourgeitai o pinakas stations sto database ean den uparxei hdh
	$mysqli->query("CREATE TABLE IF NOT EXISTS `stations` 
	( `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
	`code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
	`latitude` FLOAT NOT NULL , 
	`longitude` FLOAT NOT NULL , 
	PRIMARY KEY (`name`(255)), UNIQUE `code` (`code`(255))) ENGINE = MyISAM;")
	or die(mysql_error());

	// Eisagoume ta stoixeia tou neou sta8mou sto table
	$mysqli->query("INSERT INTO stations (name, code, latitude, longitude)
	VALUES ('$station_name', '$station_code', '$station_latitude', '$station_longitude')") 
	or die(mysql_error());

	echo " <h1>Ο σταθμός προστέθηκε!</h1>";
	
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