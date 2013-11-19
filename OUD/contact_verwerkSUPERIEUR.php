<?php
/*
Changelog : 
18-11-2013 - David de Wit aanmaak pagina 
19-11-2013 - Mies Werkende controle op velden
19-11-2013 - David htmlspecialchars voor formcontrole
19-11-2013 - Mies Vanaf nu deel van overons

*/
//Dit vraagt informatie op uit de velden in het bestand contact.php of een andere pagina op de website.
$naamvraagsteller = $_REQUEST['naam'];
$naamvraagsteller = htmlspecialchars($naamvraagsteller);//Anti HTML inject

$emailvraagsteller = $_REQUEST['email'];
$emailvraagsteller = htmlspecialchars($emailvraagsteller);//Anti HTML inject

$telefoonvraagsteller = $_REQUEST['telefoon'];
$telefoonvraagsteller = htmlspecialchars($telefoonvraagsteller);//Anti HTML inject

$berichtvraagsteller = $_REQUEST['bericht'];
$berichtvraagsteller = htmlspecialchars($berichtvraagsteller);//Anti HTML inject


//Hier word het ip adres opgevraagt
$ipadres = $_SERVER["REMOTE_ADDR"];

//Hier word de huidige datum en tijd opgevraagt
$datum = date("D, d M Y H:i:s", $_SERVER['REQUEST_TIME']);

//Einde beheerders mail 

$magmailen = "true";
if(empty($_POST['email'])){
	$alert = $alert." Email Leeg <br/>";
	$magmailen = "false";
}
if(empty($_POST['telefoon'])){
	$alert = $alert." Telefoon nummer Leeg <br/>";
	$magmailen = "false";
}
if(empty($_POST['naam'])){
	$alert = $alert."Naam Leeg <br/>";
	$magmailen = "false";
}
if(empty($_POST['bericht'])){
	$alert = $alert."Geen bericht ingevoerd <br/>";
	$magmailen = "false";
}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$alert = $alert." Foutief e-mail adres ingevoerd<br/>";
		$magmailen = "false";
}

if($magmailen == "true"){
	//verzenden bericht naar administrator
	$to = "administrator@ict-lab.nl";
	$subject = "Contactformulier babyberichten.nl";	
	$from = "autosent@babyberichten.nl";
	$headers = "From:" . $from;
	mail($to,$subject,$adminbericht,$headers);
	//verzenden bericht naar klant
	$to = $emailvraagsteller;
	$subject = "Uw Contact Aanvraag Babyberichten.nl";
	$from = "contact@babyberichten.nl";
	$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>contact_verwerk</title>
</head>
<body>
<?php
	var_dump();
	print($alert);
?>
</body>
</html>
<?php
if(isset($alert)){
	?>
		<script>alert("U heeft iets fout gedaan");</script>
	<?php
}
?>