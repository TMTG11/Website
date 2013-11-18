<?php
/*
14-11-2013 Mies - Begin activatie script (checkt alleen of gebruiker bestaat)
18-11-2013 Mies - Account word ook daadwerkelijk geactiveerd
*/
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
				$foutmeldingen[]="Helaas is er iets mis gegaan bij de activatie van uw account, probeer het later nog eens. Het probleem is vastgelegd in onze logs.";
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