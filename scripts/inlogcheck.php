<?php
	#Changelog :
	#Maarten Paauw : Aanmaken van functies voor de buttons inloggen en registreren.
	#Maarten Paauw : Functie logo.
	
	function inloggen_button($type) {
		if($_SESSION['ingelogd']) {
			if($type == "link"){
				return("http://tmtg11.ict-lab.nl/website/account.php");
			} elseif($type == "tekst") {
				return("Account");
			}
		} else {			
			if($type == "link") {
				return("http://tmtg11.ict-lab.nl/website/login.php");
			} elseif($type == "tekst") {
				return("Inloggen");
			}
		}
	}
	
	function registreren_button($type) {
		if($_SESSION['ingelogd']) {
			if($type == "link"){
				return("http://tmtg11.ict-lab.nl/website/posten.php");
			} elseif($type == "tekst") {
				return("Kaartje Maken");
			}
		} else {			
			if($type == "link") {
				return("http://tmtg11.ict-lab.nl/website/login.php");
			} elseif($type == "tekst") {
				return("Registreren");
			}
		}
	}
	
	function logo($type) {
		$array = $_SESSION["userinfo"];
		$geslacht = $array["Geslacht"];
		
		if($geslacht == "M") {
			return("http://tmtg11.ict-lab.nl/website/img/logo/logo_blauw.png");
		} else if($geslacht == "V") {
			return("http://tmtg11.ict-lab.nl/website/img/logo/logo_roze.png");
		} else {
			return("http://tmtg11.ict-lab.nl/website/img/logo/logo.png");
		}
	}
?>