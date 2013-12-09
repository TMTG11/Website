<?php
	/*
		25-11-2013 - Mies en Maarten : Begin functie.
		25-11-2013 - Maarten : Uitlezen database.
		25-11-2013 - David: Meerdere resultaten uitlezen op laatste kaartje
		25-11-2013 - David: De 2 laatste babies utilezen die toegevoegd zijn aangemaakt
	*/
	
	require_once("../connection.php");
	
	
	//Laatste kaartje op geboorte
	function laatste_kaartje() {
		$tabelkaartjes = "Kaartjes";
		
		$opdrachtlaatstgeboren = "SELECT * FROM $tabelkaartjes WHERE Bevestigd = '1' ORDER BY Geboortedatum DESC LIMIT 0,1";
		$result = mysql_query($opdrachtlaatstgeboren);
		$Rij = mysql_fetch_array($result);
		
		$array["id"] = $Rij['PostID'];	
		$array["naam"] = $Rij['Voornaam'];
		$array["tussenvoegsel"] = $Rij['Tussenvoegsel'];
		$array["achternaam"] = $Rij['Achternaam'];
		$array["tekst"] = $Rij['VrijeTekst'];
		$array["datum"] = $Rij['Geboortedatum'];
		$array["geslacht"] = $Rij['Geslacht'];
		
		return($array);
	}
	
	//Laatste kaartje op geboorte
	function kaartjeid() {
		$tabelkaartjes = "Kaartjes";
		$ID = $_GET['id'];
		
		$kaartje = "SELECT * FROM $tabelkaartjes WHERE Bevestigd = '1' AND PostID = $ID";
		$result = mysql_query($kaartje);
		$Rij = mysql_fetch_array($result);
		
		$array["id"] = $Rij['PostID'];	
		$array["naam"] = $Rij['Voornaam'];
		$array["tussenvoegsel"] = $Rij['Tussenvoegsel'];
		$array["achternaam"] = $Rij['Achternaam'];
		$array["tekst"] = $Rij['VrijeTekst'];
		$array["datum"] = $Rij['Geboortedatum'];
		$array["geslacht"] = $Rij['Geslacht'];
		$array["gewicht"] = $Rij['Geboortegewicht'];
		$array["plaats"] = $Rij['Geboorteplaats'];
		$array["provincie"] = $Rij['Provincie'];
		
		return($array);
	}
	
	//Laatste kaartje op geboorte eenarlaatste resultaat
	function eennalaatste_kaartje() {
		$tabelkaartjes = "Kaartjes";
		
		$opdrachtlaatstgeboren = "SELECT * FROM $tabelkaartjes WHERE Bevestigd = '1' ORDER BY Geboortedatum DESC LIMIT 1,1";
		$result = mysql_query($opdrachtlaatstgeboren);
		$Rij = mysql_fetch_array($result);
		
		$array["id"] = $Rij['PostID'];	
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
		
		$array["id"] = $Rij['PostID'];
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
		
		$array["id"] = $Rij['PostID'];		
		$array["naam"] = $Rij['Voornaam'];
		$array["tussenvoegsel"] = $Rij['Tussenvoegsel'];
		$array["achternaam"] = $Rij['Achternaam'];
		$array["tekst"] = $Rij['VrijeTekst'];
		$array["datum"] = $Rij['Geboortedatum'];
		$array["geslacht"] = $Rij['Geslacht'];
		
		return($array);
	}
	
	//Laatste toegevoegd kaartje op POSTID
	function toegevoegdlaatste_kaartje() {
		$tabelkaartjes = "Kaartjes";

		$opdrachtlaatstoegevoegd = "SELECT * FROM $tabelkaartjes WHERE Bevestigd = '1' ORDER BY PostID DESC LIMIT 0,1";
		$result = mysql_query($opdrachtlaatstoegevoegd);
		$Rij = mysql_fetch_array($result);
		
		$array["id"] = $Rij['PostID'];		
		$array["naam"] = $Rij['Voornaam'];
		$array["tussenvoegsel"] = $Rij['Tussenvoegsel'];
		$array["achternaam"] = $Rij['Achternaam'];
		$array["tekst"] = $Rij['VrijeTekst'];
		$array["datum"] = $Rij['Geboortedatum'];
		$array["geslacht"] = $Rij['Geslacht'];
		
		return($array);
	}
	
	///Laatste toegevoegd kaartje op POSTID eenarlaatste resultaat
	function eennatoegevoegdlaatste_kaartje() {
		$tabelkaartjes = "Kaartjes";
		
		$opdrachtlaatstoegevoegd = "SELECT * FROM $tabelkaartjes WHERE Bevestigd = '1' ORDER BY PostID DESC LIMIT 1,1";
		$result = mysql_query($opdrachtlaatstoegevoegd);
		$Rij = mysql_fetch_array($result);
		
		$array["id"] = $Rij['PostID'];		
		$array["naam"] = $Rij['Voornaam'];
		$array["tussenvoegsel"] = $Rij['Tussenvoegsel'];
		$array["achternaam"] = $Rij['Achternaam'];
		$array["tekst"] = $Rij['VrijeTekst'];
		$array["datum"] = $Rij['Geboortedatum'];
		$array["geslacht"] = $Rij['Geslacht'];
		
		return($array);
	}
?>