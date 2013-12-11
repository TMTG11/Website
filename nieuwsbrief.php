<?php 
/*
Changelog : 
2-12-2013 -  Mies : Begin nieuwsbriefscript.

________00000000000___________000000000000________
______00000000_____00000___000000_____0000000______
____0000000_____________000______________00000_____
___0000000_______________0_________________0000____
__000000____________________________________0000___
__00000_____________________________________ 0000__
_00000______________________________________00000__
_00000_____________________________________000000__
__000000_________________________________0000000___
___0000000______________________________0000000____
_____000000____________________________000000______
_______000000________________________000000________
__________00000_____________________0000___________
_____________0000_________________0000_____________
_______________0000_____________000________________
_________________000_________000___________________
_________________ __000_____00_____________________
______________________00__00_______________________

11-12-2013 - Maarten : Stijlen nieuwsbrief.

*/
if(include("/connection.php")){
session_start();


function bericht($gegevens){
	//Datum
	$datum = getdate();
	$dag = $datum["mday"];
	$maand = $datum["mon"];
	$jaar = $datum["year"];
	
	//BOVEN HET BERICHT
	$bericht = "
	<style>
		@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800);
		
		body {
			margin: auto;
			font-family: 'Open Sans';
		}
		
		#bericht {
			background-image: url('/Website/img/background_tiled.png');
			background-repeat: repeat;
			max-width: 700px;
			min-width: 400px;
			margin: auto;
			padding: 5px;
			border-bottom: #FFF solid thin;
			margin-bottom: 20px;
		}		
		#kaartje {
			border-left: 10px solid #89cff0;
			background-color: #fff;
			width:500px;
			padding: 20px;
			margin-left: auto;
			margin-right: auto;
			margin-top: 20px;
			margin-bottom: 20px;
		}
		
		.button {
			background: #89cff0;
			padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 30px;
			padding-right: 30px;
			border-radius: 2px;
			color: #FFF;
			text-decoration: none;
			text-transform: uppercase;
			font-size: 12px;
			font-weight: 600;
			border: #89cff0 solid thin;
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			float: right;
		}
		
		.button:hover {
			background: #FFF;
			color: #89cff0;
		}
		
		.naam {
			color: #fff;
			margin-left: 100px;
			margin-right: 100px;
			margin-top: 15px;
			width: 525px;
			text-align: justify;
		}
		
		.naam a {
			text-decoration: none;
			color: #fff;
			font-weight: bold;
		}
		
		.naam a:hover {
			text-decoration: underline;
		}
		
		h1 {
			font-weight: bold;
			color: #89cff0;
			font-size: 20px;
			width: 450px;
			margin: 0px;
		}
		
		h2 {
			font-weight: 100;
			font-size: 14px;
			line-height: 25px;
			width: 300px;
		}
		
		h3 {
			font-size: 12px;
			color: #89cff0;
			font-weight: 100;
		}
		
		.M_border {
			border-left: 10px solid #89cff0 !important;
		}
		
		.V_border {
			border-left: 10px solid #ffc0cb !important;
		}
		
		.M_border_bottom {
			border-bottom: 10px solid #89cff0 !important;
		}
		
		.V_border_bottom {
			border-bottom: 10px solid #ffc0cb !important;
		}
		
		.M_tekst {
			color: #89cff0 !important; 
		}
		
		.V_tekst {
			color: #ffc0cb !important;
		}
		
		.M_button {
			background: #89cff0 !important;
			border: #89cff0 solid thin !important;
		}
		
		.V_button {
			background: #ffc0cb !important;
			border: #ffc0cb solid thin !important;
		}
		
		.M_button:hover {
			background: #fff !important;
			border: #89cff0 solid thin !important;
			color: #89cff0 !important;
		}
		
		.V_button:hover {
			background: #fff !important;
			border: #ffc0cb solid thin !important;
			color: #ffc0cb !important;
		}
	</style>
	
	<div id='bericht' class='" . $gegevens["Geslacht"] . "_border_bottom'>"
	;
	
	//GROET
	$bericht = $bericht . "<h1 class='naam'>Hallo " . $gegevens["Voornaam"] . " " . $gegevens["Tussenvoegsel"] . " " . $gegevens["Achternaam"] . ",</h1><h2 class='naam'>Hierbij de nieuwsbrief van " . date('d-m-Y') . " met daarin alle geboortekaartjes die vandaag toegevoegd zijn. Wilt u meer, minder of geen geboortekaartjes ontvangen? Ga dan naar uw account instellingen en ze de module nieuwsbrief uit.</h2>";
	$query = "SELECT * FROM Kaartjes WHERE Bevestigd = '1'";
	if($gegevens["Nieuwsbriefprovincie"]!= "0"){
		$query = $query." AND Provincie = '".$gegevens["Nieuwsbriefprovincie"]."'";
	}
	$query .= " AND Toegevoegd LIKE '%$jaar-$maand-$dag%'"; 
	$opdracht = mysql_query($query);
	//KAARTJES
	while($rij2 = mysql_fetch_array($opdracht)){
		$babies .= "<div class='" . $rij2['Geslacht'] . "_border' id='kaartje'>";
		$babies .= "<h1 class='" . $rij2['Geslacht'] . "_tekst' >" . $rij2['Voornaam']." ";
		$babies .= $rij2['Tussenvoegsel']." ";
		$babies .= $rij2['Achternaam']."</h1>";
		$babies .= "<h2>" . $rij2['VrijeTekst']."</h2>";
		$babies .= "<h3 class='" . $rij2['Geslacht'] . "_tekst' >" . $rij2['Geboortedatum']."</h3>";
		$babies .= "<a class='button " . $rij2['Geslacht'] . "_button' target='_blank' href='http://tmtg11.ict-lab.nl/website/kaartje.php?id=" . $rij2['PostID'] . "'>Kaartje bekijken</a><br/><br/>"; 
		$babies .= "</div>";
	}
	//AFSLUITER
	$bericht = $bericht.$babies."<h2 class='naam'>Afmelden voor de nieuwsbrief? klik dan <a href='#' target'_blank'>hier</a>.</h2></div>";
	if($babies == ""){
		return("true");
	}
	return($bericht);
}


	//ophalen e-mail adressen en versturen mails
	//aanmaken inhoud met babies enzo
	$opdracht = mysql_query("SELECT * FROM gebruiker WHERE WilMail = '1'");
	while($rij = mysql_fetch_array($opdracht)){
		$array[]=$rij;
	}
	$count = count($array);
	for($i=1;$i<=$count;$i++){
			$bericht = bericht($array[($i-1)]);
			if($bericht == "true"){
				$inhoud .= $array[($i-1)]["Voornaam"]." Heeft geen mail gekregen<br/>";
			}else{
				$subject = 'TMTG11 : Nieuwsbrief voor ' . $array[($i-1)]["Voornaam"] . " " . $array[($i-1)]["Tussenvoegsel"] . " " . $array[($i-1)]["Achternaam"];
				$headers   = array();
				$headers[] = "MIME-Version: 1.0";
				$headers[] = "Content-type: text/html; charset=iso-8859-1";
				$headers[] = "From: No Reply <noreply@ict-lab.nl>";
				$headers[] = "Reply-To: No Reply <noreply@ict-lab.nl>";
				$headers[] = "Subject: {$subject}";
				$headers[] = "X-Mailer: PHP/".phpversion();
				
				$inhoud .= $bericht;
				//mail('tmtg11@ict-lab.nl', $subject, $bericht , implode("\r\n", $headers));
			}
	}
}else{
	$inhoud = "Fout met de Bug (Connection.php ontbreekt)";
}
			
			//versturen mail
			

?>
<!DOCTYPE html>
<head>
<title>NIET BEZOEKEN | Nieuwsbrief | Babyberichten.nl</title>
</head>
<html>
<!-- TEST ONLY -->
<?php 
	print($inhoud);
?>
</html>