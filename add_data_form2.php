<?php
session_start();
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title> Ρύποι ΥΠΕΚΑ </title></head>
<body>	

<?php

$target_dir="uploads/"; //fakelos pou 8a ginontai upload ta arxeia ston server
$target_file=$target_dir.basename($_FILES["fileToUpload"]["name"]);
$uploadOk=1;
$fileType=pathinfo($target_file, PATHINFO_EXTENSION); // pairnoume ton tupo tou arxeiou


if ((isset($_SESSION["admin"]) )&& ($_SESSION["admin"]==1)){
	if(isset($_POST["submit"])){ // an exei ginei submit h forma tou add_data_form1
		if($fileType=="csv"){ //Elegxos an to arxeio einai csv
			echo '<h1>Το αρχείο είναι CSV</h1><br>';
			$uploadOk=1;
		}else{
			echo '<h1>Το αρχείο δεν είναι CSV </h1><br>';
			$uploadOk=0;
		}
	}

	if (file_exists($target_file)){ // elegxoume an uparxei hdh to arxeio
		echo '<h1>Το αρχείο υπάρχει ήδη </h1><br>';
		$uploadOk=0;
	}
	
	if ($uploadOk==0){ // elegxoume an to flag mas einai 0 logw kapoiou error k ektupwnoume katallhlo mhnuma
		echo '<h1> Δεν ήταν δυνατό το ανέβασμα του αρχείου </h1><br>';
	
	}else{ // An pane ola kala, ginetai anevasma tou arxeiou
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)){
			echo "<h1>Το αρχείο ".basename($_FILES["fileToUpload"]["name"]). "ανέβηκε επιτυχώς!</h1>";
			
			include 'includes/dbconnect.php';
			$year= $_POST["year"];
			$gas=$_POST["gas"];
			$station_name=$_POST['station_select_form'];
			
			// Gia na paroume ton kwdiko sta8mou, efoson den ton zhtame sthn forma, 8a diastavrwsoume me to onoma sta8mou, apo ton pinaka stations
			// Etsi 8a mporesoume na ftia3oume ton pinaka gia to antistoixo CSV, ws e3hs : <onoma sta8mou>$<etos>$<tupso rupou>
			$result = $mysqli->query("SELECT name, code FROM `stations`")or die(mysql_error()); 
			while ($row = $result->fetch_assoc()) {
				if ($row['name']==$station_name)
					$station_code=$row['code'];
			}
			//Dhmiourgia tou table opws orisame parapanw me 25 sthles, mia gia hmeromhnia kai alles 24 gia tis wres ths hmeras
			$mysqli->query("CREATE TABLE "."`$station_code$$year$$gas`"."( `date` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour01` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour02` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `hour03` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour04` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `hour05` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour06` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `hour07` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour08` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `hour09` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour10` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `hour11` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour12` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `hour13` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour14` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `hour15` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour16` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `hour17` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour18` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `hour19` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour20` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `hour21` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour22` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `hour23` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			`hour24` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL) ENGINE = MyISAM")
			or die(mysql_error());
			//Perasma twn timwn tou CSV ston pinaka tou database mas
			$mysqli->query("load data local infile '$target_file' into table `$station_code$$year$$gas` fields terminated by ',' enclosed by '\"' lines terminated by '\n'")
			or die(mysql_error());				
				
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
				
		}else{
			echo '<h1>Υπήρξε κάποιο πρόβλημα στο ανέβασμα του αρχείου. </h1><br>';
		}
	
	}
}else {
	echo '<div class="message-box">Παρακαλώ συνδεθείτε ως διαχειριστής για να δείτε το περιεχόμενο!</div><br>';
}
?>

</body>
</html>
