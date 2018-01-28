<?php
session_start();

if ((isset($_SESSION["admin"]) )&& ($_SESSION["admin"]==0)){

// Selida statistikwn me asugxronh ananewsh me AJAX
// Kanoume include to AJAX kai orizoume mia sunarthsh startRefresh h opoia ananewnetai ka8e 0,01 sec. 
// Pairnei ta dedomena apo to: user_statistics_mysql kai ta eisagei sto div: stage

echo ' 
<html>

   <head>
      <link rel="stylesheet" type="text/css" href="style2.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title> Ρύποι ΥΠΕΚΑ </title>
      <script type = "text/javascript" 
         src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
		<script type = "text/javascript" language = "javascript">
		startRefresh();
		$(function() {
			startRefresh();
		});

		function startRefresh() {
			setTimeout(startRefresh,1000);
			$.get("user_statistics_mysql.php", function(data) {
				$("#stage").html(data);    
			});
		}
		
      </script>
   </head>
	
   <body>
	 <div id = "stage" >
      </div>
	  		
   </body>
	
	</html>';
	  
	
		echo '
	<form id="menu-button2" action="user_index.php" method="get">
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
	echo '<div class="message-box">Παρακαλώ συνδεθείτε για να δείτε το περιεχόμενο</div>';
}
     
		
