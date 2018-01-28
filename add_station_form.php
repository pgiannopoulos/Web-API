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
if ((isset($_SESSION["admin"]) )&& ($_SESSION["admin"]==1)){ //Forma pros8hkhs neou sta8mou
	echo "<h1>Δηλώστε τα στοιχεία του σταθμού που θέλετε να προσθέσετε:</h1> <br>";
	
	echo'
	<form name="add_station" method="post" action="add_station.php"> 
		<input type="text" name="station_name" placeholder="Όνομα σταθμού" required pattern=".{5,}" title="At least 5 characters" autofocus ><br> 
		<input type="text" name="station_code" placeholder="Κωδικός σταθμού" required pattern=".{3,4}" title="3 to 4 Characters"><br> 
		<input type="text" name="station_latitude" placeholder="Γεωγραφικό πλάτος" required pattern="[0-9.]{6,12}" title="6 to 12 Characters"><br> 
		<input type="text" name="station_longitude" placeholder="Γεωγραφικό μήκος" required pattern="[0-9.]{6,12}" title="6 to 12 Characters"><br> 
		<input id="action" type="submit" value="Προσθήκη"> 
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