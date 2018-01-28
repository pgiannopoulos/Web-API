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

if (isset($_SESSION["admin"]) ){

	echo "<h1>Δηλώστε τα στοιχεία της ρύπανσης που επιθυμείτε:</h1> <br>";
	echo' <p><form name="abs_form" method="post" action="return_avg.php" enctype="multipart/form-data"> <br>
			<select required name="gas" >
			<option value="first" disabled selected hidden style=" color: #333 ">Διαλέξτε τύπο ρύπου</option>
			<option value="CO">CO</option>
			<option value="O3">O3</option>
			<option value="NO">NO</option>
			<option value="NO2">NO2</option>
			<option value="SO2">SO2</option>
			<option value="NOX">NOX</option>
			<option value="Smoke">Smoke</option>
			</select><br>
			<input type="text" name="station_code" placeholder="Κωδικός σταθμού" pattern=".{3,4}" title="3 to 4 characters or leave blank for all stations"><br> 
			<input type="text" name="duration" placeholder="Χρονικό Διάστημα" pattern=".{4,10}" required title="YYYY or MM-YYYY or DD-MM-YYYY"><br> 
			<input id="action" type="submit" value="Υποβολή"> 
			</form></p>

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