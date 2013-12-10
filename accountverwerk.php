<?php
require ("connection.php");
session_start();
//Hier word het huidige gebruikersID opgrvraagt uit de sessie
$sessioninfo = $_SESSION["userinfo"];
$id = $sessioninfo["GebruikersID"];
//SQL Injectie Controleren + velden opvragen
$voornaam = mysql_real_escape_string($_POST['voornaam']);
$tussen = mysql_real_escape_string($_POST['tussen']);
$achternaam = mysql_real_escape_string($_POST['achternaam']);
$email = mysql_real_escape_string($_POST['email']);
$geboortedatum = mysql_real_escape_string($_POST['geboortedatum']);
$woonplaats = mysql_real_escape_string($_POST['woonplaats']);
$geslacht = mysql_real_escape_string($_POST['geslacht']);
$bericht = mysql_real_escape_string($_POST['bericht']);

//Hier word de opdracht gemaakt om alles in de tabel te zetten	
$tabelnaam ="gebruiker";
$opdracht = "UPDATE $tabelnaam SET Voornaam='$voornaam', Tussenvoegsel='$tussen', Achternaam='$achternaam', Woonplaats='$woonplaats', Geboortedatum='$geboortedatum',Email='$email', Geslacht='$geslacht' WHERE GebruikersID = '$id'";
	echo $opdracht;
	if (mysql_query($opdracht)){
		header('Location: account.php');
	}else{
		echo "Er is iets fout gegaan: <br>".mysql_error;
	}

?>