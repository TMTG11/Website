<?php
/*
TO DO :
Mogelijk melding indien account al actief is
Nieuw Logscript

Changelog : 
14-11-2013 Mies - Begin activatie script (checkt alleen of gebruiker bestaat)
18-11-2013 Mies - Account word ook daadwerkelijk geactiveerd
26-11-2013 Mies - Doorverwijzing naar inlog.php
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
			header('Location: http://tmtg11.ict-lab.nl/website/login.php?actief=true');
		}else{
			header('Location: http://tmtg11.ict-lab.nl/website/login.php?actief=false');
		}
	}else{
		header('Location: http://tmtg11.ict-lab.nl/website/login.php?actief=notfound');
	}
}else{
	header('Location: http://tmtg11.ict-lab.nl/website/login.php?actief=error');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>E-mail verificatie | Babyberichten.nl</title>
	<link rel="shortcut icon" type="image/ico" href="img/logo/favicon.ico"/>
</head>
<body>
	Er is iets vreselijk mis gegaan. <a href="http://tmtg11.ict-lab.nl/website/">Klik hier om terug te gaan naar de index pagina.</a>
</body>
</html>