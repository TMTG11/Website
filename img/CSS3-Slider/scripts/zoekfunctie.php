<?php
require_once("../connection.php");
	
	
//Laatste kaartje op geboorte
function zoekfunctie() {
	
//Hier word de zoekcatagorie opgehaald
$searchveld = $_REQUEST['search'];//Type Zoekopdacht naam/woonplaats etc

if ($searchveld == "voornaam"){
	$zoekcatagorie = "Voornaam";
}
else if ($searchveld == "achternaam"){
	$zoekcatagorie = "Achternaam";
}
else if ($searchveld == "geboortedatum"){
	$zoekcatagorie = "Geboortedatum";
}
else if ($searchveld == "geboorteplaats"){
	$zoekcatagorie = "Geboorteplaats";
}

else
{
	echo "NOT WORKING!";	
}

$zoeken = $_REQUEST['zoekopdracht'];//De precieze naam of plaats die gezocht word

$tabelnaam="kaartjes";


//Zoekt op soortgelijke Voornaam
$opdracht = "SELECT * FROM $tabelnaam WHERE $zoekcatagorie LIKE '%$zoeken%'";
$result = mysql_query($opdracht);
//Zet de tabel klaar
$Rij = mysql_fetch_array($result);
				
		$array["naam"] = $Rij['Voornaam'];
		$array["tussenvoegsel"] = $Rij['Tussenvoegsel'];
		$array["achternaam"] = $Rij['Achternaam'];
		$array["tekst"] = $Rij['VrijeTekst'];
		$array["datum"] = $Rij['Geboortedatum'];
		$array["geslacht"] = $Rij['Geslacht'];
		
		
}
?>