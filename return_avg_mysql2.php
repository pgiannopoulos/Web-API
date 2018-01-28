

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include 'includes/dbconnect.php';
$sum1=0;
$sum2=0;
$hmerhsio_plithos = 0;
$ethsio_plithos = 0;
$code=$_POST['station_code'];
$gas=$_POST['gas'];
$duration = $_POST['duration'];
$year = substr($duration, -4); //epistrefoume ta 4 teleytaia stoixeia eisodou wste na paroume to etos
$length = strlen($_POST['duration']); // analoga to length tou xronikou diasthmatos, katalavainoume an edwse mia mera, h ena mhna , h ena etos
	

if ($code == "")
{
	$table = "%"."$".$year."$".$gas; // ftiaxnoume to onoma tou pinaka me vash ta stoixeia eisodou
	$result1 = $mysqli->query("SELECT latitude,longitude FROM stations ORDER BY code ASC" ) or die(mysql_error());
}
else
{
	$table = $code."$".$year."$".$gas; // ftiaxnoume to onoma tou pinaka me vash ta stoixeia eisodou
	$result1 = $mysqli->query("SELECT latitude,longitude FROM stations WHERE code LIKE '$code'" ) or die(mysql_error());
}

$result2 = $mysqli->query("SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = 'webapi' AND table_name LIKE '$table' ORDER BY table_name ASC");

$outp = "[";
while($row1 = $result2->fetch_array()) {
	$row2 = $result1->fetch_array();
	if ($outp != "[") {$outp .= ",";}
    $outp .= '{"Latitude":"'  . $row2["latitude"] . '",'; 
	$outp .= '"Longitude":"'. $row2["longitude"]     . '",'; 
	$table = $row1["table_name"];

if ($length==4)   // ean exei dwsei yyyy
{
	$result = $mysqli->query(" SELECT  * FROM $table ") or die(mysql_error());
	while($row3 = $result->fetch_array()) 
	{
		for ($i = 1; $i <= 24; $i++) 
		{
			if ($row3[$i]!= -9999)
			{
				$sum1 += $row3[$i];
				$sum2 += pow($row3[$i], 2);
				$ethsio_plithos += 1;
			}
		}	
	}
	if ($ethsio_plithos == 0)
	{
		$avg = "Μη διαθέσιμα δεδομένα";
		$dev = "Μη διαθέσιμα δεδομένα";
	}
	else
	{
		$avg = $sum1/$ethsio_plithos;
		$dev_avg = $sum2/$ethsio_plithos; 
		$dev = sqrt($dev_avg - pow($avg, 2));
	}
$outp .= '"Avg":"'  . "$avg" . '",'; 
$outp .= '"Dev":"'  . "$dev" . '"}'; 
}

if ($length==7)  // ean dld exei dwsei mm-yyyy
{
	$duration = "%".$duration;
	$result = $mysqli->query(" SELECT  * FROM $table WHERE date LIKE '$duration'") or die(mysql_error());
	while($row3 = $result->fetch_array()) 
	{
		for ($i = 1; $i <= 24; $i++) 
		{
			if ($row3[$i]!= -9999)
			{
				$sum1 += $row3[$i];
				$sum2 += pow($row3[$i], 2);
				$ethsio_plithos += 1;
			}
		}	
	}
	if ($ethsio_plithos == 0)
	{
		$avg = "Μη διαθέσιμα δεδομένα";
		$dev = "Μη διαθέσιμα δεδομένα";
	}
	else
	{
		$avg = $sum1/$ethsio_plithos;
		$dev_avg = $sum2/$ethsio_plithos;
		$dev = sqrt($dev_avg - pow($avg, 2));
	}
$outp .= '"Avg":"'  . "$avg" . '",'; 
$outp .= '"Dev":"'  . "$dev" . '"}'; 
}

if ($length==10)  // ean exei dwsei dd-mm-yyyy
{
	$result = $mysqli->query(" SELECT * FROM $table WHERE date LIKE '$duration' ") or die(mysql_error());
	while($row3 = $result->fetch_array()) 
	{
		for ($i = 1; $i <= 24; $i++) 
		{
			if ($row3[$i]!= -9999)
			{
				$sum1 += $row3[$i];
				$sum2 += pow($row3[$i], 2);
				$hmerhsio_plithos += 1;
			}
		}
	}
	if ($hmerhsio_plithos == 0)
	{
		$avg = "Μη διαθέσιμα δεδομένα";
		$dev = "Μη διαθέσιμα δεδομένα";
	}
	else
	{
		$avg = $sum1/$hmerhsio_plithos;
		$dev_avg = $sum2/$hmerhsio_plithos;
		$dev = sqrt($dev_avg - pow($avg, 2));
	}
$outp .= '"Avg":"'  . "$avg" . '",'; 
$outp .= '"Dev":"'  . "$dev" . '"}'; 


}
}
$outp .="]";;
echo $outp;
file_put_contents ( "testing.txt" , $outp ); // dhmiourgia txt gia na travh3oume to json kai na perasoume t dedomena ston xarth mesw tou demo website
header("Location: testerino.php"); //redirect sto demo website 
delete("testing.txt");

?>

