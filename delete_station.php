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
	
	$station_name = $_POST["station_select_form"]; // Pername se topikh metavlhth to onoma sta8mou pou ferame apo th forma
	
	$result = $mysqli->query("SELECT name, code FROM `stations`")or die(mysql_error());
	while ($row = $result->fetch_assoc()) { // Gia na vroume ton kwdiko me vash to onoma kanoume diastayrwsh ston pinaka stations mesw tou name
		if ($row['name']==$station_name)
			$station_code=$row['code'];
	}
	//Diagrafh ths kataxwrhshs
	$mysqli->query("DELETE FROM stations WHERE name='$station_name' ") or die(mysql_error());
	//Diagrafh antistoixwn arxeiwn
	foreach (glob("uploads/"."*"."$station_code"."*.csv") as $filename) {
		unlink($filename);
	}
	// diagrafh twn pinakwn pou perieixan metrhseis gia ton sta8mo auto
	$result=$mysqli->query("SELECT CONCAT('DROP TABLE ',table_name)
				FROM information_schema.tables
				WHERE table_name LIKE '$station_code%' ");
	while ($row = $result->fetch_assoc()) {
        $drop=$row["CONCAT('DROP TABLE ',table_name)"];
		$mysqli->query("$drop")or die(mysql_error());;
    }
	
			
	echo " <h1>Ο σταθμός διαγράφηκε !</h1><br>";
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
	echo '<div class="message-box"> Παρακαλώ συνδεθείτε ως διαχειριστής για να δείτε αυτό το περιεχόμενο!</div>';
}
?>
</body>
</html>