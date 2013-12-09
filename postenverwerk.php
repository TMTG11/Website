<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Posten Verwerk</title>
</head>
<?php
session_start();
require ("connection.php");
//SQL Injectie Controleren + velden opvragen
$voornaam = mysql_real_escape_string($_POST['Voornaam']);
$tussen = mysql_real_escape_string($_POST['Tussenvoegsel']);
$achternaam = mysql_real_escape_string($_POST['Achternaam']);

$email = mysql_real_escape_string($_POST['email']);
$geboorteplaats = mysql_real_escape_string($_POST['Geboorteplaats']);
$provincie= mysql_real_escape_string($_POST['provincielist']);
$geboortedatum = mysql_real_escape_string($_POST['geboortedatum']);
$geslacht = mysql_real_escape_string($_POST['Geslacht']);
$text = mysql_real_escape_string($_POST['Persoonlijketekst']);
$gewicht = mysql_real_escape_string($_POST['Gewicht']);
$bestand = $_FILES["file"];
$bevestigd = 0;

//Hier word het huidige gebruikersID opgrvraagt uit de sessie
$sessioninfo = $_SESSION["userinfo"];
$id = $sessioninfo["GebruikersID"];

//Hier word alles weggeschreven in de daarvoor bestemde tabel
$tabelnaam="kaartjes";

//Afbeelding
$afbeeldingnaam = $bestand['name'];
$temp = $bestand['tmp_name'];	
//Afbeelding

//Hier word het in de tabel gezet
$opdracht = "INSERT INTO $tabelnaam (GebruikersID,Voornaam,Tussenvoegsel,Achternaam,Geboortegewicht,Geboortedatum,Geboorteplaats,Geslacht,VrijeTekst,Afbeeldingslocatie,Provincie,Bevestigd ) values('$id','$voornaam','$tussen','$achternaam','$gewicht','$geboortedatum','$geboorteplaats','$geslacht','$text','$afbeeldingnaam','$provincie','$bevestigd')";
if(mysql_query($opdracht)){
	echo "Het aanmelden is gelukt!";
}else{
	echo "Het aanmelden is niet gelukt, probeer het opnieuw.".mysql_error();
	echo $opdracht;
}
//Hier word het POST_ID uitgelezen
$opdracht2 = mysql_query("SELECT PostID FROM $tabelnaam WHERE VrijeTekst = '$text' AND Geboortedatum = '$geboortedatum'");
$result2 = mysql_fetch_array($opdracht2);

///Afbeelding
if(move_uploaded_file($bestand['tmp_name'], "../database/upload/babies".$afbeeldingnaam)){
	header('Location: kaartje.php?id='.$result2["PostID"]);
}else{
	echo "De afbeelding is niet verplaatst!";
}
//Afbeelding
mysql_close ($Verbinding);
?>
<body>
</body>
</html>