# Changelog :
# Maarten Paauw : Aanmaken van functies voor de buttons inloggen en registreren.

<?php
	require_once('../connection.php');
	
	function inloggen_button {
		if ($ingelogd) {
			$link = "http://www.google.nl/?true=true";
			$tekst = "Account";
		} else {
			$link = "http://www.google.nl/?false=false";
			$tekst = "Inloggen";
		}
	}
	
	function registreren_button {
		if($ingelogd) {
			$link = "http://www.google.nl/?true=true";
			$tekst = "Posten";
		} else {
			$link = "http://www.google.nl/?false=false";
			$tekst = "Registreren";
		}
	}
	
	function logo {
		if($jongen) {
			$link = "http://www.google.nl/?true=true"; 
		} else if($meisje) {
			$link = "http://www.google.nl/?true=true";
		} else {
			$link = "http://www.google.nl/?true=true";
		}
	}
?>