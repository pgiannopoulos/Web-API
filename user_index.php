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
if ((isset($_SESSION["admin"]) )&& ($_SESSION["admin"]==0)){
			echo "<h1>Καλως ορίσατε ! </h1><br>";
			
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
	<form action="user_statistics.php" method="get">
	<input type="submit" value="Προβολή στατιστικών" 
        name="Submit" id="return_stations_submit" />
	</form>
	';
	echo '
<form id="logout-button2" action="logout.php" method="get">
    <input type="submit" value="Αποσύνδεση" 
         name="Submit" id="logout_submit" />
</form>
';
}else {
	echo ' <div class="message-box">Παρακαλώ συνδεθείτε ως χρήστης για να δείτε το περιεχόμενο</div> ';
	}
?>
</body>
</html>
	