<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title> Ρύποι ΥΠΕΚΑ </title>
</head>
<body>

<?php

	$email = $_POST["email"];
	$password = $_POST["password"];
	$salt="alataki";
	$API_key = md5($salt.$email); // MD5 hash gia dhmiourgia hashing sto apikey

	include 'includes/dbconnect.php';
		//Dhmiourgia tou pinaka users ean den uparxei prohgoumenh eggrafh
		$mysqli->query("CREATE TABLE IF NOT EXISTS `users` 
		( `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
		`password` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
		`API_key` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
		`station_request` FLOAT NOT NULL ,
		`abs_request` FLOAT NOT NULL ,
		`avg_request` FLOAT NOT NULL ,
		PRIMARY KEY (`email`(255)), UNIQUE `API_key` (`API_key`(255))) ENGINE = MyISAM;")
		or die(mysql_error());
		// eisagwgh twn stoixeiwn tou user sto table users
		$result = $mysqli->query("INSERT INTO users (email, password, API_key, station_request, abs_request, avg_request)VALUES ('$email', '$password', '$API_key', '0', '0', '0')");
		echo "<h1>Εγγραφήκατε με επιτυχία!</h1>";
	
echo '
<form id="menu-button" action="index.php" method="get">
    <input type="submit" value="Επιστροφή για σύνδεση!" 
         name="Submit"  />
</form>';
?>

</body>
</html>