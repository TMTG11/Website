<?php
	session_start();
	require_once('scripts/inlogcheck.php');
	require_once('scripts/kaartjes.php');
	
	$geslacht = kleuren();
/*
session_start();
//LOGGERSCIPT 7-11-2013 Mies
include("whitelist.php");
$log = "Echten Site : ".date("Y-m-d H:i:s")." "."\n";//Voeg variabelen toe VOOR de \n, dan komen ze in de log file. 
if(in_array($_SERVER['REMOTE_ADDR'],$whitelist)){
	$succes="U word niet gevolgd";	
}else{
	file_put_contents("database/log.".$_SERVER['REMOTE_ADDR'].".php",$log, FILE_APPEND | LOCK_EX);
}


Changelog : 
07-11-2013 - Mies : Logscript
11-11-2013 - Maarten en Andre : Aanmaak pagina, aanmaak CSS, velen divs gemaakt.
12-11-2013 - Maarten en Andre : Header & searchbalk.
13-11-2013 - Maarten : Verder gegaan aan de vormgeving.
19-11-2013 - Mies kleine aanpassingen aan form
19-11-2013 - Mies rewrite mailscript, formverificatie, e-mail en dergelijke
19-11-2013 - David HTMLSpecialchars voor variablen e-mail. Compacter gemaakt door Mies (Gewoon $_POST[] ipv variabel met $_POST erin en dan HTMLSpecialchars)
19-11-2013 Mies uitschakelen loggerscript IVM problemen met head en body (knees & Toes).
2-12-2013 David: Zoeken op plaatsnaam met provincie erbij
*/
if(isset($_POST["zoeken"])){
	//Hier word het ip adres opgevraagt
	$ipadres = $_SERVER["REMOTE_ADDR"];

	//Hier word de huidige datum en tijd opgevraagt
	$datum = date("D, d M Y H:i:s", $_SERVER['REQUEST_TIME']);

	//Check van Velden - Mies
	$magmailen = "true";
	if(empty($_POST['email'])){
		$alert = $alert." Email Leeg <br/>";
		$magmailen = "false";
	}
	if(empty($_POST['telefoon'])){
		$alert = $alert." Telefoon nummer Leeg <br/>";
		$magmailen = "false";
	}
	if(empty($_POST['naam'])){
		$alert = $alert."Naam Leeg <br/>";
		$magmailen = "false";
	}
	if(empty($_POST['bericht'])){
		$alert = $alert."Geen bericht ingevoerd <br/>";
		$magmailen = "false";
	}
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$alert = $alert." Foutief e-mail adres ingevoerd<br/>";
			$magmailen = "false";
	}
	if($magmailen == "true"){
		//Variabelen voor e-mail. -David
		$naamvraagsteller = htmlspecialchars($_POST['naam']);
		$emailvraagsteller = htmlspecialchars($_POST['email']);
		$telefoonvraagsteller = htmlspecialchars($_POST['telefoon']);
		$berichtvraagsteller = htmlspecialchars($_POST['bericht']);
		//Hier word het ip adres opgevraagt
		$ipadres = $ipadres;
		//Hier word de huidige datum en tijd opgevraagt
		$datum = date("D, d M Y H:i:s", $_SERVER['REQUEST_TIME']);
		//Mail Templates, idee van mies om grote lappen tekst midden in code te voorkomen
		require_once("scripts/mailtemplates.php");
		//verzenden bericht naar administrator - Mies
		$to = "administrator@ict-lab.nl";
		$subject = "Contactformulier babyberichten.nl";	
		$from = "autosent@babyberichten.nl";
		$headers = "From:" . $from;
		mail($to,$subject,$adminbericht,$headers);
		//verzenden bericht naar klant - Mies
		$to = $emailvraagsteller;
		$subject = "Uw Contact Aanvraag Babyberichten.nl";
		$from = "contact@babyberichten.nl";
		$headers = "From:" . $from;
		mail($to,$subject,$klantmail,$headers);
		$alert="Uw bericht is verzonden. <br/>We nemen binnenkort contact met u op";
	}
	//Scripts die kunnen worden uitgevoerd. - mies
	$scripts = "window.onload = function() {
	  window.scrollTo(0,document.body.scrollHeight);
	};";
}
if(!isset($alert)){
	$alert="Heeft u een vraag?<br/> Vul dan het onderstaande contactformulier in en wij nemen binnen 24 uur contact met u op.";
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   		<title>Over ons | Babyberichten.nl</title>
        
        <link rel="icon" href="<?php print(favicon("link")); ?>" type="img/logo/x-icon"/> 
		<link rel="shortcut icon" type="image/ico" href="<?php print(favicon("link")); ?>"/>
        
        <link rel="stylesheet" type="text/css" href="css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <!--Dit zorgt roept alle autocomplete functies op-->
	
	<!-- Dit CSS bestand is specifiek voor de jQuery UI onderdelen -->
	<link href="scripts/jquery/Aristo.css" rel="stylesheet" type="text/css" />
	
	<!-- Eerst moet jQuery worden geladen -->
	<script type="text/javascript" src="scripts/jquery/jquery-1.8.2.js"></script>

	<!-- Dan moet de jQuery UI worden geladen, deze bevat de autocomplete code -->
	<script type="text/javascript" src="scripts/jquery/jquery-ui-1.9.0.custom.min.js"></script>

	<!-- nu moeten we jQuery vertellen dat we het formulierveld willen gebruiken voor autocomplete -->
	<script type="text/javascript">

	// start deze jQuery code als het document geladen is ("document ready")
	$(document).ready(function() 
	{
		// activeer autocomplete voor het veld met ID "stad"
		$("#stad").autocomplete({
			
			// geef aan welk bestand als bron voor de lijst dient
			source: "scripts/citylist.php",
			
			// geef aan vanf hoeveel ingetypte letters de autocomplete actief moet worden
			minLength: 2
		});
	});
	</script>
		
	</head>
    </head>
    
    <body>
    	<div id="container"> 
    	  	<!-- MENU -->
        	<div id="menu" class="<?php print $geslacht ?>_border_top">
				<div class="wrapper">
                    <!-- LOGO -->
					<div id="logo">
						<a href="index.php"><img src="<?php print(logo("link")); ?>" width="256" height="63" alt="Logo" /></a>
					</div> <!-- Einde logo -->
                    <!-- MENU ITEMS -->
					<div id="menu_items">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="overons.php">Over ons</a></li>
							<li><a href="babies.php" class="current_active">Babies</a></li>
							<li><a href="<?php print(inloggen_button("link")); ?>"><?php print(inloggen_button("tekst")); ?></a></li>
						</ul>
					</div> <!-- Einde menu_items -->		
					<div id="menu_button">
						<a href="<?php print(registreren_button("link")); ?>" class="button <?php print $geslacht ?>_button"><?php print(registreren_button("tekst")); ?></a>
					</div> <!-- Einde menu_button -->		
				</div> <!-- Einde wrapper -->
            </div> <!-- Einde menu -->
           
            <!-- HEADER -->
            <div id="header">
            	<div class="wrapper">
					<?php $array_kaartje = laatste_kaartje(); ?>
                	<div id="post_header" class="<?php print($array_kaartje["geslacht"]); ?>_border">
                    	<p>
                        	<h1 class="<?php print($array_kaartje["geslacht"]); ?>_tekst"><?php print($array_kaartje["naam"]) . " "; print($array_kaartje["tussenvoegsel"]) . " "; print($array_kaartje["achternaam"]);?></h1>
                            <h2><?php print($array_kaartje["tekst"]); ?></h2>
                            <h3 class="<?php print($array_kaartje["geslacht"]); ?>_tekst"><?php print($array_kaartje["datum"]); ?></h3>
                    	</p>
                    	<a href="http://tmtg11.ict-lab.nl/website/kaartje.php?id=<?php print($array_kaartje["id"]); ?>" class="button right <?php  print($array_kaartje["geslacht"]); ?>_button">Kaartje bekijken</a>
                    </div> <!-- Einde post_header --> 
                </div> <!-- Einde wrapper -->
            </div> <!-- Einde header -->
            
            <!-- SEARCH -->
            <div id="search">
            	<div class="wrapper">
                	<form id="form_zoek" class="form_zoek" method="post" action="zoeken.php">
                    	<table border="0" width="100%">
                        	<tr>
                            	<td width="250">
                                    <select name="search" class=" <?php print $geslacht ?>_select">
                                        <option value="voornaam">Voornaam</option>
                                        <option value="achternaam">Achternaam</option>
                                        <option value="geboortedatum">Geboortedatum</option>
                                        <option value="geboorteplaats">Geboorteplaats</option>
                                    </select>
                                </td>
                                <td width="540"><input name="zoekopdracht" type="text" placeholder="zoekopdracht" class=" <?php print $geslacht ?>_border_box"/></td>
                                <td width="150"><input name="zoeken" type="submit" value="zoeken" class="button <?php print $geslacht ?>_button" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div> <!-- Einde wrapper -->
            </div> <!-- Einde search -->
            
            <!-- KAARTJES -->
            <div class="kaartjesnummer3">
            	<div class="wrapper">
					<?php $array_kaartjeid = kaartjeid(); ?>
                	<h4><?php print($array_kaartjeid["naam"]) . " "; print($array_kaartjeid["tussenvoegsel"]) . " "; print($array_kaartjeid["achternaam"]);?></h4>
                    <div id="contact" class="<?php print $array_kaartjeid["geslacht"]; ?>_border">
					
                            <h2><span class="bold">Gewicht:</span><br/><?php print($array_kaartjeid["gewicht"]); ?> gram</h2>
							<h2><span class="bold"><br/>Geboortedatum:<br/></span> <?php print($array_kaartjeid["datum"]); ?></h2>
							<h2><span class="bold"><br/>Geboorteplaats:<br/></span> <?php print($array_kaartjeid["plaats"]); ?></h2>
							<h2><span class="bold"><br/>Provincie:<br/></span> <?php print($array_kaartjeid["provincie"]); ?></h2>
							
							<h2><span class="bold"><br/>Tekst:</span></h2>
							<h2><?php print($array_kaartjeid["tekst"]); ?></h2>
							<img src="img/background_header.png" class="photo" />
							<a href="#"><img src="img/social/<?php print $array_kaartjeid["geslacht"]; ?>_facebook.png" class="facebook" /></a>
							<a target="_blank" href="https://twitter.com/intent/tweet?source=webclient&text=Ons%20kind%20<?php print($array_kaartjeid["naam"]); ?>%20is%20geboren.%20Bekijk%20het%20geboortekaartje%20hier:%20http://tmtg11.ict-lab.nl/website/kaartje.php?id=<?php print($array_kaartjeid["id"]); ?>%20%23schoolopdracht"><img src="img/social/<?php print $array_kaartjeid["geslacht"]; ?>_twitter.png" class="twitter" /></a>
							<a href="#"><img src="img/social/<?php print $array_kaartjeid["geslacht"]; ?>_google.png" class="google" /></a>
                    </div> <!-- Einde post_header -->
                    <!-- Einde post_header -->
            	</div> <!-- Einde wrapper -->
            </div> <!-- Einde kaartjes -->
               
			<!-- CONTENT -->
            <div class="content">
            	<div class="wrapper">
            	
					<div class="padding"></div>
					
						<!--<div class="image right">
							<img src="img/background_header.png"/>
						</div>  --> <!-- Einde image -->
						
						<div class="blok">
							<p>
								<h1 class="<?php print $geslacht ?>_tekst">Geposte berichten</h1>
								<h2>Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. passages van Lorem Ipsum beschikbaar maar het.</h2>
							</p>
						</div> <!-- Einde blok -->
						
							<hr class="line">
							
						<!--<div class="image right">
							<img src="img/background_header.png"/>
						</div>  --> <!-- Einde image -->
						
						<div class="blok">
							<p>
								<h1 class="<?php print $geslacht ?>_tekst">Een post toevoegen</h1>
								<h2>Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. passages van Lorem Ipsum beschikbaar maar het.</h2>
							</p>
						</div> <!-- Einde blok -->
						
					<div class="padding"></div>	
					
                </div> <!-- Einde wrapper -->
            </div> <!-- Einde content -->
			
            <!-- FOOTER -->
            <div id="footer" class="<?php print $geslacht ?>_achtergrond">
            	<div class="wrapper">
	            		<div class="right">
	            			<p>
	            				<a href="https://www.facebook.com/sharer/sharer.php?u=http://TMTG11.ict-lab.nl/website" target="_blank"><img src="img/social/facebook_white.png" width="40" /></a>
                                <a href="https://plusone.google.com/_/+1/confirm?hl=en&url=http://TMTG11.ict-lab.nl/website" target="_blank"><img src="img/social/google_white.png" width="40"/></a>
                                <a href="http://twitter.com/home?status=http://TMTG11.ict-lab.nl/website" target="_blank"><img src="img/social/twitter_white.png" width="40"/></a>
	            			</p>
	            		</div>
	            		<div>
	            			<p>
	            				&copy; TMTG11<br/>
								Maarten Paauw, Mies van der Lippe, David de Wit &amp; Andre Dongen
	            			</p>
	            		</div>
            	</div> <!-- Einde wrapper -->
            </div> <!-- Einde footer -->
        </div> <!-- Einde container -->
		<script>
			<?php
			//Defineer scripts in de PHP code bovenaan.
			print($scripts);
			?>
		</script>
    </body>
</html>
