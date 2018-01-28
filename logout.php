<?php
  session_start();
?>


<?php
	session_unset();	
	// diagrafh session
	session_destroy(); // kai epeita redirect sto index 
	header("Location: index.php");
?>


