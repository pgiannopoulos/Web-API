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

include 'includes/dbconnect.php';
$email = $_POST["email"];
$password = $_POST["password"];
$admin_mail = 'damager@yahoo.gr';

$result = $mysqli->query("SELECT * FROM users WHERE email = '$email' AND password = '$password' ") or die(mysql_error()); // Diastayrwsh mail kai pass gia travhgma eggrafwn users apo th vash
$row = $result->fetch_array();

	// Efoson oi eggrafes pou erxontai exoun antistoixismeno email me pass de xreiazetai na ginei elegxos, afou hdh o kwdikos 8a einai o swstos an exei epistrafei eggrafh
	if ($email==$admin_mail){ // An einai to mail tou admin, redirect sto menu tou
		
		$_SESSION["admin"] = 1; // Session admin orizetai me 1 gia na 3eroume se ka8e session pws exei dikaiwmata admin
		$_SESSION["api_key"] = $row['API_key'] ; // Kratame panw sthn global session to apikey ka8ws 8eloume na metrame ta requests argotera se diafora arxeia
		header("Location: admin_index.php");

	}else {  // An einai to mail tou user, redirect sto menu tou
		
		$_SESSION["admin"] = 0; // Session admin orizetai me 0 gia na 3eroume se ka8e session pws exei dikaiwmata user
		$_SESSION["api_key"] = $row['API_key'] ;  // Kratame panw sthn global session to apikey ka8ws 8eloume na metrame ta requests argotera se diafora arxeia
		header("Location: user_index.php");	}
?>

</body>
</html>	