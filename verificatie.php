<?php
/*
TO DO :
Mogelijk melding indien account al actief is
Nieuw Logscript

Changelog : 
14-11-2013 Mies - Begin activatie script (checkt alleen of gebruiker bestaat)
18-11-2013 Mies - Account word ook daadwerkelijk geactiveerd
26-11-2013 Mies - Doorverwijzing naar inlog.php
26-11-2013 Mies - Comments
*/
include("../connection.php");
$activatiecode = mysql_real_escape_string($_GET["code"]);
$email = mysql_real_escape_string($_GET["email"]);
$opdracht2 = mysql_query("SELECT * FROM gebruiker WHERE Email='$email' AND VerificatieCode='$activatiecode'");
//Als de opdracht word uitgevoerd word het volgende script gedraaid.
if($opdracht2){
	//Gegevens worden opgeslagen in een Array
	$array=mysql_fetch_array($opdracht2);
	//Array word geteld, als er een gebruiker word gevonden zitten er veel gegevens in.
	if(count($array)>1){
		//De foutmeldingen op deze pagina worden niet aan de gebruiker weergegeven, in plaats daarvan word de gebruiker doorverwezen met een melding.
		$foutmeldingen[]="Gebruiker gevonden";
		//Er word een Query aangemaakt om de gebruiker te activeren
		$activatie = mysql_query("UPDATE gebruiker SET IsVerified = 1;");
		//Als de activatie succesvol is word de gebruiker doorverwezen.
		if($activatie){
			header('Location: http://tmtg11.ict-lab.nl/website/login.php?actief=true');
		}else{
		//Als de activatie faalt word men ook doorverwezen
			header('Location: http://tmtg11.ict-lab.nl/website/login.php?actief=false');
		}
	}else{
	//Melding voor als de gebruiker niet word gevonden
		header('Location: http://tmtg11.ict-lab.nl/website/login.php?actief=notfound');
	}
}else{
	//Melding voor als de eerste query faalt.
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