<?php
session_start();
?>

<?php
if ((isset($_SESSION["admin"]) )){
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'includes/dbconnect.php';

$code=$_SESSION['code'];
$hour = $_SESSION['hour'];
$hour = "hour".$hour;
$gas = $_SESSION['gas'];
$date = $_SESSION['date'];
$year = substr($date, -4); // pairnoume ta 4 teleytaia pshfia tou date gia na krathsoume to etos

if ($code == "") // An den dw8ei sta8mos epilegontai oloi
{
	$table = "%"."$".$year."$".$gas;
	$result1 = $mysqli->query("SELECT latitude,longitude FROM stations ORDER BY code ASC" ) or die(mysql_error()); // pairnoume tis sintetagmenes tous
}
else // GIa sugkekrimeno sta8mo
{
	$table = $code."$".$year."$".$gas;
	$result1 = $mysqli->query("SELECT latitude,longitude FROM stations WHERE code LIKE '$code'" ) or die(mysql_error()); //pairnoume tis sintetagmenes tou
}
//Epistrefei tous pinakes pou anaferontai ston sugkekrimeno sta8mo/sta8mous
$result2 = $mysqli->query("SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = 'webapi' AND table_name LIKE '$table' ORDER BY table_name ASC"); 
//Dhmiourgia tou JSON gia thn epistrofh apoluths timhs rupanshs
$outp = "[";
	while($row1 = $result2->fetch_array()) {
		$row2 = $result1->fetch_array();
		if ($outp != "[") {$outp .= ",";}
		$outp .= '{"Latitude":"'  . $row2["latitude"] . '",'; 
		$outp .= '"Longitude":"'. $row2["longitude"]     . '",'; 
		$new = $row1["table_name"];

		$result3 = $mysqli->query("SELECT $hour FROM $new WHERE date LIKE '$date' " ) or die(mysql_error());
		while($row3 = $result3->fetch_array()) {
			if ($row3[$hour]==-9999)
				$outp .= '"rupos":"'  . 'Μη διαθέσιμη' . '"}'; 
			else
				$outp .= '"rupos":"'  . $row3[$hour] . '"}'; 
		}
	}
$outp .="]";
echo $outp;
file_put_contents ( "testing.txt" , $outp );

}else {
	echo ' <div class="message-box">Παρακαλώ συνδεθείτε για να δείτε αυτό το περιεχόμενο!</div>';
}
?>

