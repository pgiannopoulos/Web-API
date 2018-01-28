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
	
		$result = $mysqli->query(" SELECT name FROM stations ")or die(mysql_error()); // me mia select travame ta onomata twn stathmwn gia na ftia3oume to dropdown ths formas
	
		echo
			'<h1>Συμπληρώστε τα στοιχεία του σταθμού που θέλετε να εισάγετε:</h1>';
	
		echo 
			'<p><form name="add_data1" method="post" action="add_data_form2.php" enctype="multipart/form-data"> 
			<select required name="station_select_form">			<option disabled selected value> Διαλέξτε όνομα σταθμού </option>';
			
		while($row = $result->fetch_array()){
			echo '<option value="'; echo $row['name']; echo '"> '; echo $row['name']; echo '</option>'; // dropdown me onomata stathmwn pou ferame apo th vash
		}
		
		 echo // pedia formas : Etos - Rupos 
			'</select><br><input type="text" name="year"  placeholder="Ετος αναφοράς" required pattern="[0-9]{4}" min="1984" max="2020"title="4 Digits"><br> 
			<select required name="gas">
			<option disabled selected value> Διαλέξτε τύπο ρύπου </option>
			<option value="CO">CO</option>
			<option value="O3">O3</option>
			<option value="NO">NO</option>
			<option value="NO2">NO2</option>
			<option value="SO2">SO2</option>
			<option value="NOX">NOX</option>
			<option value="Smoke">Smoke</option>
			</select><br>';
	
		echo // pedio epiloghs arxeiou csv
			'<br>
			<input type="file" name="fileToUpload" id="fileToUpload" class="inputfile" required />
			<label for="fileToUpload">Επιλογή αρχείου CSV</label>		<br><br><br><br>
			<input type="submit" id="action" value="Ανέβασμα" name="submit">
			</form></p>';
	
		echo 
			'<form id="menu-button" action="admin_index.php" method="get">
			<input type="submit" value="Επιστροφή στο μενού" name="Submit" />
			</form>';
		
		echo 
			'<form id="logout-button" action="logout.php" method="get">
			<input type="submit" value="Αποσύνδεση" name="Submit"  />
			</form>';
}
else {
	echo ' <div class="message-box">Παρακαλώ συνδεθείτε ως διαχειριστής για να δείτε αυτό το περιεχόμενο!</div>';
}

?>
</body>
</html>