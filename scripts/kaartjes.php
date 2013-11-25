<?php
	/*
		25-11-2013 - Mies en Maarten : Begin functie.
	*/
	
	require_once('../connection.php');
	$tabelkaartjes = "kaartjes";
	
	function laatste_kaartje() {
		$opdrachtlaatsgeboren = "SELECT * FROM $tabelkaartjes WHERE Bevestigd = '1' ORDER BY Geboortedatum DESC LIMIT 0, 1";
		$result = mysql_query($opdrachtlaatsgeboren);
		$Rij = mysql_fetch_array($result);
		
		$array["naam"] = $Rij['Naam'];
		$array["tekst"] = $Rij['VrijeTekst'];
		$array["datum"] = $Rij['Geboortedatum'];
		
		return($array);
	}
?>