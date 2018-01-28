<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title> Ρύποι ΥΠΕΚΑ </title>
</head>
<body>
<div class="container">
	<div class="login">
	<h1> Φόρμα εγγραφής: </h1>
	<form id="register_form" name="register_form" method="post" action="register.php"> </p>
		<p><input id="email" type="email" name="email" placeholder="Email" required  autofocus autocomplete=off> </p>
		<p><input id="password" type="password" name="password" placeholder="Κωδικός" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" 
		title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters"> 
		<p class="submit"><input type="submit" value="Εγγραφή">  </p>
	</form>
	</div>
</div>
</body>
</html>