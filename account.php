<?php
	session_start();
	require_once('scripts/inlogcheck.php');
	require_once('scripts/kaartjes.php');
	
	$geslacht = kleuren();
	
/*
Changelog
25-11-2013 Mies Aanmaak Account.php Eerste scripts. Uitlogknop
26-11-2013 Mies	Maken form. Prefill form
26-11-2013 Mies	Comments

*/

//Als de sessie niet gevonden is word je automatisch doorverwezen naar de login pagina
if(!$_SESSION["ingelogd"]){
	header('Location: http://tmtg11.ict-lab.nl/website/login.php');
}
//Als de uitlog knop is ingedrukt word de sessie verwijdert en de gebruiker doorverwezen.
if($_GET["uitloggen"]=="ja"){
	session_destroy();
	header('Location: http://tmtg11.ict-lab.nl/website/login.php?melding=uitgelogd');
}
//Gegevens worden opgehaald uit de database DMV ID uit sessie
$sessioninfo = $_SESSION["userinfo"];
$id = $sessioninfo["GebruikersID"];
$opdracht = mysql_query("SELECT * FROM gebruiker WHERE GebruikersID = '$id'");
$array = mysql_fetch_array($opdracht);
//Update voor account
if(isset($_POST["update"])){
	$alert="Update button ingedrukt";
}

//ALS ER GEEN ALERTS ZIJN WORD DE VOLGENDE TEKST WEERGEGEVEN
if(!isset($alert)){
	$alert="Welkom op de account pagina";
	$class = $geslacht."_border";
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   		<title><?php print(inloggen_button("tekst")); ?> | Babyberichten.nl</title>
        
        <link rel="icon" href="<?php print(favicon("link")); ?>" type="img/logo/x-icon"/> 
		<link rel="shortcut icon" type="image/ico" href="<?php print(favicon("link")); ?>"/>
        
        <link rel="stylesheet" type="text/css" href="css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        
        <!-- Dit zorgt voor het zoeken op plaatsnamen met Autocomplete!-->
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
    <?php /*var_dump($_POST);*/ ?>
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
							<li><a href="babies.php">Babies</a></li>
							<?php 
							//Door middel van functies word hieronder bepaalt wat de inhoud van de Registreren en Account knop is.
							?>
							<li><a href="<?php print(inloggen_button("link"));?>" class="current_active"><?php print(inloggen_button("tekst")); ?></a></li>
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
							<!-- Kaartje op de slider word gevuld -->
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
                	<form id="form_zoek" class="form_zoek" method="post" action="allebabies.php">
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
			
			<!-- MELDINGEN -->
			<div class="kaartjes padding_bottom">
           		<div class="wrapper">
            		<div id="meldingen" class="<?php print($class);?>">
                    	<h2>
							<?php
                                print($alert);
                            ?>
                        </h2>
                	</div> <!-- Einde meldingen -->
                </div> <!-- Einde wrapper -->
            </div> <!-- Einde kaartjes -->
                   
			 <!-- CONTACT -->
            <div class="kaartjes">
            	<div id="account" class="<?php print $geslacht ?>_border">
            		<div class="wrapper">
                    	<span class="right">
							<input name="zoeken" type="submit" value="Uitloggen" class="button logout" onClick="window.location='http://tmtg11.ict-lab.nl/website/account.php?uitloggen=ja'"/>
								<br/>
							<input name="zoeken" type="submit" value="Account pagina" class="button <?php print $geslacht ?>_button" onClick="window.location='http://tmtg11.ict-lab.nl/website/account.php'"/>
								<br/>
							<input name="zoeken" type="submit" value="Kaartje toevoegen" class="button <?php print $geslacht ?>_button" onClick="window.location='http://tmtg11.ict-lab.nl/website/posten.php'"/>
						</span>
                        
                        	<h1 class="<?php print $geslacht ?>_tekst">Gegevens</h1>
                            <h2>Vul informatie hieronder aan:</h2>
                           
                            <form method="post" action="accountverwerk.php">
                            	<table>
                                	<tr>
                                       <td><label>Voornaam:</label><input name="voornaam" type="text" value="<?php if(isset($array["Voornaam"])) { print($array["Voornaam"]); } ?>"  placeholder="<?php if(!isset($array["Voornaam"])) { print("Voornaam"); } ?>"  /></td>
                                    </tr>
                                    <tr>
                                        <td><label>Tussenvoegsel:</label><input name="tussen" type="text" value="<?php if(isset($array["Tussenvoegsel"])) { print($array["Tussenvoegsel"]); } ?>" placeholder="<?php if(!isset($array["Tussenvoegsel"])) { print("Tussenvoegsel"); } ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><label>Achternaam:</label><input name="achternaam" type="text" value="<?php if(isset($array["Achternaam"])) { print($array["Achternaam"]); } ?>" placeholder="<?php if(!isset($array["Achternaam"])) { print("Achternaam"); } ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><label>E-mail adres:</label><input name="email" type="text" value="<?php if(isset($array["Email"])) { print($array["Email"]); } ?>" placeholder="<?php if(!isset($array["Email"])) { print("E-mail"); } ?>" /></td>
                                    </tr>
                                    <tr>
                                    	<td><label>Woonplaats:</label><input name="woonplaats" id="stad" type="text" value="<?php if(isset($array["Woonplaats"])) { print ($array["Woonplaats"]); } ?>" placeholder="<?php if(!isset($array["Woonplaats"])) { print("Woonplaats"); } ?>" /></td>
                                    </tr>
                                    <tr>
										<td>
											<label>Provincie:</label>
											<select name="provincielist">
												<?php if(isset($array["Provincie"])) { print ("<option value=" . $array["Provincie"] . ">" . $array["Provincie"] . "</option>"); } else { print("<option value=''>Selecteer uw provincie...</option>"); } ?>
												<option value="Noord-Holland">Noord-Holland</option>
												<option value="Zuid-Holland">Zuid-Holland</option>
												<option value="Utrecht">Utrecht</option>
												<option value="Flevoland">Flevoland</option>
												<option value="Groningen">Groningen</option>
												<option value="Friesland">Friesland</option>
												<option value="Drenthe">Drenthe</option>
												<option value="Overijsel">Overijssel</option>
												<option value="Gelderland">Gelderland</option>
												<option value="Noord-Brabant">Noord-Brabant</option>
												<option value="Limburg">Limburg</option>
												<option value="Zeeland">Zeeland</option>
											</select>
										</td>
									</tr>
									<tr>
                                        <td><label>Geboortedatum:</label> <input name="geboortedatum" type="date" value="<?php if(isset($array["Geboortedatum"])) { print($array["Geboortedatum"]); } ?>" placeholder="<?php if(!isset($array["Geboortedatum"])) { print("31/12/2013"); } ?>" /></td>
                                    </tr>
                                    <tr>
										<td><label>Foto:</label><INPUT name="file" type="file" name="file" required/></td>
									</tr>
                                    <tr>
										<td><label>Geslacht:</label>
											<select name="geslacht">
											<?php
												if($array["Geslacht"] == "M") {
													?>
														<option value="M">Man</option>
														<option value="V">Vrouw</option>
													<?php
												} else if($array["Geslacht"] == "V") {
													?>
														<option value="V">Vrouw</option>
														<option value="M">Man</option>
													<?php
												} else {
													?>
														<option value="A">Selecteer een geslacht...</option>
														<option value="M">Man</option>
														<option value="V">Vrouw</option>
													<?php
												}
											?>
											</select>
										</td>
									</tr>
									<tr>
										<td><label>Nieuwsbrief:</label>
											<select name="geslacht" width="180" style="width: 180px; margin-left: 13px;">
											<?php
												if($array["WilMail"] == "0") {
													?>
														<option value="M">Niet ontvangen</option>
														<option value="V">Wel ontvangen</option>
													<?php
												} else if($array["WilMail"] == "1") {
													?>
														<option value="V">Wel ontvangen</option>
														<option value="M">Niet ontvangen</option>
													<?php
												} else {
													?>
														<option value="A">Selecteer een optie...</option>
														<option value="M">Wel ontvangen</option>
														<option value="V">Niet ontvangen</option>
													<?php
												}
											?>
											</select>
										
											<select name="provincielist" width="180" style="width: 180px;">
												<option value="">Selecteer uw provincie...</option>
												<option value="*">Alle provincies</option>
												<option value="Noord-Holland">Noord-Holland</option>
												<option value="Zuid-Holland">Zuid-Holland</option>
												<option value="Utrecht">Utrecht</option>
												<option value="Flevoland">Flevoland</option>
												<option value="Groningen">Groningen</option>
												<option value="Friesland">Friesland</option>
												<option value="Drenthe">Drenthe</option>
												<option value="Overijsel">Overijssel</option>
												<option value="Gelderland">Gelderland</option>
												<option value="Noord-Brabant">Noord-Brabant</option>
												<option value="Limburg">Limburg</option>
												<option value="Zeeland">Zeeland</option>
											</select>
										</td>
									</tr>
                                    <tr>
                                        <td><label>Vrije tekst:</label><textarea name="bericht" cols=25 rows="6" maxlength="750"  placeholder="<?php if(isset($array["Vrije Tekst"])) { print($array["Vrije Tekst"]); } else { print("Uw bericht..."); } ?>"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><input name="update" type="submit" value="Update uw account" class="button <?php print $geslacht ?>_button" /></td>
                                    </tr>
                                </table>
                            </form>
                            
                	</div> <!-- Einde wrapper -->
                </div> <!-- Einde contact -->
            </div> <!-- Einde kaartjes -->
            
            <!-- CONTENT -->
            <div class="content">
            	<div class="wrapper">
					<div class="padding"></div>
						<div class="image right">
							<img src="img/background_header.png"/>
						</div> <!-- Einde image -->
						<div class="blok"><p>
								<h1 class="<?php print $geslacht ?>_tekst">Account pagina</h1>
								<h2>Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. passages van Lorem Ipsum beschikbaar maar het.</h2>
							</p>
							</div> <!-- Einde blok -->
							<hr class="line">
						<div class="blok right">
							<p>
								<h1 class="<?php print $geslacht ?>_tekst">Account pagina</h1>
								<h2>Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. passages van Lorem Ipsum beschikbaar maar het.</h2>
							</p>
						</div> <!-- Einde blok -->
					
						<div class="image">
							<img src="img/background_header.png"/>
						</div> <!-- Einde image -->
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
    </body>
</html>

</body>
</html>