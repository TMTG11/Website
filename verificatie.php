<?php
include("../connection.php");
$activatiecode = mysql_real_escape_string($_GET["code"]);
$email = mysql_real_escape_string($_GET["email"]);
$opdracht2 = mysql_query("SELECT * FROM gebruiker WHERE Email='$email' AND VerificatieCode='$activatiecode'");
//$opdracht = ;
	if($opdracht2){
		$array=mysql_fetch_array($opdracht2);
		if(count($array)>1){
			$foutmeldingen[]="Gebruiker gevonden";
			$activatie = mysql_query("UPDATE gebruiker SET IsVerified = 1;");
			if($activatie){
				$foutmeldingen[]="Uw account is geactiveerd";
			}else{
				$foutmeldingen[]="Query Zuigt mofo";
			}
		}else{
			$foutmeldingen[]="Gebruiker niet gevonden.";
		}
	}else{
		$foutmeldingen[]="Opgefokt";
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title>E-mail verificatie | Babyberichten.nl</title>
</head>
<body>
<?php 
	print_r($foutmeldingen);
?>
</body>
</html>