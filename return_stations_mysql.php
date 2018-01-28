<?php
session_start();
?>

<?php
if (isset($_SESSION["admin"]) ){

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'includes/dbconnect.php';
$result = $mysqli->query("SELECT * FROM stations" ) or die(mysql_error());

// dhmiourgia tou JSON 
$outp = "[";
while($row = $result->fetch_array()) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"Name":"'  . $row["name"] . '",';
    $outp .= '"Code":"'   . $row["code"]        . '",';
    $outp .= '"Latitude":"'. $row["latitude"]     . '",'; 
	$outp .= '"Longitude":"'. $row["longitude"]     . '"}'; 
}
$outp .="]";

echo($outp);
file_put_contents ( "testing2.txt" , $outp ); // dhmiourgia txt gia na travh3oume to json kai na perasoume t dedomena ston xarth mesw tou demo website
}
else {
	echo ' <div class="message-box">Παρακαλώ συνδεθείτε για να δείτε αυτό το περιεχόμενο!</div>';
}
?>

