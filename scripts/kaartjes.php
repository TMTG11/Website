<?php
	/*
		25-11-2013 - Mies en Maarten : Begin functie.
		25-11-2013 - Maarten : Uitlezen database.
	*/
	
	require_once("../connection.php");
	
	
	
	function laatste_kaartje() {
		$tabelkaartjes = "Kaartjes";
		
		$opdrachtlaatstgeboren = "SELECT * FROM $tabelkaartjes WHERE Bevestigd = '1' ORDER BY Geboortedatum DESC LIMIT 1";
		$result = mysql_query($opdrachtlaatstgeboren);
		$Rij = mysql_fetch_array($result);
				
		$array["naam"] = $Rij['Voornaam'];
		$array["tussenvoegsel"] = $Rij['Tussenvoegsel'];
		$array["achternaam"] = $Rij['Achternaam'];
		$array["tekst"] = $Rij['VrijeTekst'];
		$array["datum"] = $Rij['Geboortedatum'];
		$array["geslacht"] = $Rij['Geslacht'];
		
		return($array);
	}
	
	function laatste_jongen() {
		$tabelkaartjes = "Kaartjes";
		
		$opdrachtlaatstgeboren = "SELECT * FROM $tabelkaartjes WHERE Bevestigd = '1' AND Geslacht = 'M' ORDER BY Geboortedatum DESC LIMIT 1";
		$result = mysql_query($opdrachtlaatstgeboren);
		$Rij = mysql_fetch_array($result);
				
		$array["naam"] = $Rij['Voornaam'];
		$array["tussenvoegsel"] = $Rij['Tussenvoegsel'];
		$array["achternaam"] = $Rij['Achternaam'];
		$array["tekst"] = $Rij['VrijeTekst'];
		$array["datum"] = $Rij['Geboortedatum'];
		$array["geslacht"] = $Rij['Geslacht'];
		
		return($array);
	}
	
	function laatste_meisje() {
		$tabelkaartjes = "Kaartjes";
		
		$opdrachtlaatstgeboren = "SELECT * FROM $tabelkaartjes WHERE Bevestigd = '1' AND Geslacht = 'V' ORDER BY Geboortedatum DESC LIMIT 1";
		$result = mysql_query($opdrachtlaatstgeboren);
		$Rij = mysql_fetch_array($result);
				
		$array["naam"] = $Rij['Voornaam'];
		$array["tussenvoegsel"] = $Rij['Tussenvoegsel'];
		$array["achternaam"] = $Rij['Achternaam'];
		$array["tekst"] = $Rij['VrijeTekst'];
		$array["datum"] = $Rij['Geboortedatum'];
		$array["geslacht"] = $Rij['Geslacht'];
		
		return($array);
	}
?>