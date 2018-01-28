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

if ((isset($_SESSION["admin"]) )&& ($_SESSION["admin"]==1)){ // Selida menou epilogwn tou diaxeiristh

	echo "<h1>Καλως όρισες Διαχειριστή ! </h1><br>";
		
		
	//koympi pros8hkhs
	echo ' 
	<form action="add_station_form.php" method="get">
	<input type="submit" value="Προσθήκη σταθμού" 
        name="Submit" id="add_station_submit" />
	</form>
	';
	
	//koympi diagrafhs
	echo ' 
	<form action="delete_station_form.php" method="get">
	<input type="submit" value="Διαγραφή σταθμού" 
        name="Submit" id="delete_station_submit" />
	</form>
	';
		
	//koympi eisagwghs dedomenwn
	echo ' 
	<form action="add_data_form1.php" method="get">
	<input type="submit" value="Προσθήκη Δεδομένων" 
        name="Submit" id="add_data_submit" />
	</form>
	';
	//koympi return stations
	echo ' 
	<form action="return_stations.php" method="get">
	<input type="submit" value="Σταθμοί καταγραφής" 
        name="Submit" id="return_stations_submit" />
	</form>
	';
	//koympi return abs
	echo ' 
	<form action="return_abs_form.php" method="get">
	<input type="submit" value="Απόλυτη τιμή ρύπανσης" 
        name="Submit" id="return_stations_submit" />
	</form>
	';
	//koympi return avg
	echo ' 
	<form action="return_avg_form.php" method="get">
	<input type="submit" value="Μέση τιμή ρύπανσης" 
        name="Submit" id="return_stations_submit" />
	</form>
	';
	//koympi statistics
	echo ' 
	<form action="admin_statistics.php" method="get">
	<input type="submit" value="Προβολή στατιστικών" 
        name="Submit" id="return_stations_submit" />
	</form>
	';
		
	// koumpi log out
	echo ' 
	<form id="logout-button2" action="logout.php" method="get">
    <input type="submit" value="Αποσύνδεση" 
        name="Submit" id="logout_submit" />
	</form>
	';
}
else {
	echo '<div class="message-box">Παρακαλώ συνδεθείτε ως διαχειριστής για να δείτε το περιεχόμενο</div>';
}
?>
</body>
</html>	