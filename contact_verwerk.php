
<?php
//Lege velkden verzenden nog
//Telefoonnummer word nog niet gecontroleerd en email
if (!empty($_POST)){
	if(!empty($_POST["naam"]) && ($_POST["email"]) && ($_POST["telefoon"]) && ($_POST["bericht"])){
	$naamvraagsteller = mysql_real_escape_string ($_POST["naam"]);
	$email = mysql_real_escape_string ($_POST["email"]);
	$telefoon = mysql_real_escape_string ($_POST["telefoon"]);
	$bericht = mysql_real_escape_string ($_POST["bericht"]);
	}

}

?>

<?php
//David de Wit 18-11-2013

//Dit vraagt informatie op uit de velden in het bestand contact.php of een andere pagina op de website.
$naamvraagsteller = $_REQUEST['naam'];
$naamvraagsteller = htmlspecialchars($naamvraagsteller);//SQL Injectie

$emailvraagsteller = $_REQUEST['email'];
$emailvraagsteller = htmlspecialchars($emailvraagsteller);//SQL Injectie

$telefoonvraagsteller = $_REQUEST['telefoon'];
$telefoonvraagsteller = htmlspecialchars($telefoonvraagsteller);//SQL Injectie

$berichtvraagsteller = $_REQUEST['bericht'];
$berichtvraagsteller = htmlspecialchars($berichtvraagsteller);//SQL Injectie


//Hier word het ip adres opgevraagt
$ipadres = $_SERVER["REMOTE_ADDR"];

//Hier word de huidige datum en tijd opgevraagt
$datum = date("D, d M Y H:i:s", $_SERVER['REQUEST_TIME']);





//Dit is de mail die verstuurt word als ontvangstbevestiging naar de persoon die de vraag heeft opgestuurt.

$to = $emailvraagsteller;
$subject = "Uw Contact Aanvraag Babyberichten.nl";
$message = "Hallo $naamvraagsteller,

Uw email is succesvol verzonden!
Wij zullen zo snel mogelijk uw vraag in behandeling nemen.

Met vriendelijke groet,

babyberichten.nl ";
$from = "contact@babyberichten.nl";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);






//Dit is de mail met de vraag die gestuurt word naar de beheerders van de website

$to = "administrator@ict-lab.nl";
$subject = "Contactformulier babyberichten.nl";
$message = "Hallo,

Er is zojuist een contact aanvraag gedaan op babyberichten.nl door $naamvraagsteller.

Hier zijn alle gegevens van deze aanvraag op een rij:

Ip adres:
$ipadres

Tijd en datum:
$datum

Naam:
$naamvraagsteller

Email adres:
$emailvraagsteller

Telefoonnummer:
$telefoonvraagsteller

Bericht:
$berichtvraagsteller

Dit was een geautomatiseerd bericht vanaf babyberichten.nl
Dit bericht is alleen voor de administrator bedoeld!";
$from = "autosent@babyberichten.nl";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);

//Dit stuurt je terug naar de index:

header('Location: http://tmtg11.ict-lab.nl/website?emailisverzonden=true');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>contact_verwerk</title>
</head>

<body>

</body>
</html>
