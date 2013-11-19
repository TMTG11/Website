<?php
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
		$naamvraagsteller = htmlspecialchars($_REQUEST['naam']);
		$emailvraagsteller = htmlspecialchars($_REQUEST['email']);
		$telefoonvraagsteller = htmlspecialchars($_REQUEST['telefoon']);
		$berichtvraagsteller = htmlspecialchars($_REQUEST['bericht']);
		//Hier word het ip adres opgevraagt
		$ipadres = "Hier zou het IP adres kunnen komen";
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
        
        <link rel="icon" href="img/logo/favicon.ico" type="img/logo/x-icon"/> 
		<link rel="shortcut icon" type="image/ico" href="img/logo/favicon.ico"/>
        
        <link rel="stylesheet" type="text/css" href="css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
		
	</head>
    </head>
    
    <body>
    	<div id="container"> 
    	  	<!-- MENU -->
        	<div id="menu">
				<div class="wrapper">
                    <!-- LOGO -->
					<div id="logo">
						<a href="index.php"><img src="img/logo/logo_blauw.png" width="256" height="63" alt="Logo" /></a>
					</div> <!-- Einde logo -->
                    <!-- MENU ITEMS -->
					<div id="menu_items">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="overons.php" class="current_active">Over ons</a></li>
							<li><a href="babies.php">Babies</a></li>
							<li><a href="login.php">Inloggen</a></li>
						</ul>
					</div> <!-- Einde menu_items -->		
					<div id="menu_button">
						<a href="#" class="button">registreren</a>
					</div> <!-- Einde menu_button -->		
				</div> <!-- Einde wrapper -->
            </div> <!-- Einde menu -->
           
            <!-- HEADER -->
            <div id="header">
            	<div class="wrapper">
                	<div id="post_header">
                    	<p>
                        	<h1>Maarten Paauw</h1>
                            <h2>Hier komt de tekst over de baby.</h2>
                            <h3>31-12-2013</h3>
                    	</p>
                    	<a href="#" class="button right">Kaartje</a>
                    </div> <!-- Einde post_header --> 
                </div> <!-- Einde wrapper -->
            </div> <!-- Einde header -->
            
            <!-- SEARCH -->
            <div id="search">
            	<div class="wrapper">
                	<form>
                    	<table border="0" width="100%">
                        	<tr>
                            	<td width="250">
                                    <select name="search">
                                        <option value="voornaam">Voornaam</option>
                                        <option value="achternaam">Achternaam</option>
                                        <option value="roepnaam">Roepnaam</option>
                                        <option value="geboortedatum">Geboortedatum</option>
                                        <option value="geboorteplaats">Geboorteplaats</option>
                                        <option value="geslacht">Geslacht</option>
                                    </select>
                                </td>
                                <td width="540"><input name="" type="text" placeholder="zoekopdracht"/></td>
                                <td width="150"><input name="zoeken" type="submit" value="zoeken" class="button" /></td>
                            </tr>
                        </table>
                    </form>
                </div> <!-- Einde wrapper -->
            </div> <!-- Einde search -->
            
            <!-- CONTENT -->
            <div class="content">
            	<div class="wrapper">
					<div class="padding"></div>
						<div class="image right">
							<img src="img/background_header.png"/>
						</div> <!-- Einde image -->
						<div class="blok">
							<p>
								<h1>Index pagina</h1>
								<h2>Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. passages van Lorem Ipsum beschikbaar maar het.</h2>
								</p>
						</div> <!-- Einde blok -->
							<hr class="line">
						<div class="blok right">
							<p>
								<h1>Index pagina</h1>
								<h2>Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. passages van Lorem Ipsum beschikbaar maar het.</h2>
							</p>
						</div> <!-- Einde blok -->
					
						<div class="image">
							<img src="img/background_header.png"/>
						</div> <!-- Einde image -->
					<div class="padding"></div>	
                </div> <!-- Einde wrapper -->
            </div> <!-- Einde content -->
            
            <!-- CONTACT -->
            <div class="kaartjes">
            	<div id="contact">
            		<div class="wrapper">
                    	<p>
                        	<h1>Contactformulier</h1>
                            <h2><?php print($alert);?></h2>
                            <form method="post" action="overons.php">
                            	<table>
                                	<tr>
                                        <td><input name="naam" type="text" placeholder="Voor- & Achternaam" required/></td>
                                    </tr>
                                    <tr>
                                        <td><input name="email" type="text" placeholder="E-mail adres" required/></td>
                                    </tr>
                                    <tr>
                                        <td><input name="telefoon" type="text" placeholder="Telefoonnummer" required/></td>
                                    </tr>
                                    <tr>
                                        <td><textarea name="bericht" cols=25 rows="6" maxlength="750" required placeholder="Uw bericht..."></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><input name="zoeken" type="submit" value="Verzenden" class="button" /></td>
                                    </tr>
                                </table>
                            </form>
                        </p>
                	</div> <!-- Einde wrapper -->
                </div> <!-- Einde contact -->
            </div> <!-- Einde kaartjes -->
               
            <!-- FOOTER -->
            <div id="footer">
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
