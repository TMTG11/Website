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
	$class = "normaal";
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   		<title>Inloggen | Babyberichten.nl</title>
        
        <link rel="icon" href="<?php print(favicon("link")); ?>" type="img/logo/x-icon"/> 
		<link rel="shortcut icon" type="image/ico" href="<?php print(favicon("link")); ?>"/>
        
        <link rel="stylesheet" type="text/css" href="css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <?php var_dump($_POST);?>
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
							<?php //Kaartje op de slider word gevuld?>
                        	<h1 class="<?php print($array_kaartje["geslacht"]); ?>_tekst"><?php print($array_kaartje["naam"]) . " "; print($array_kaartje["tussenvoegsel"]) . " "; print($array_kaartje["achternaam"]);?></h1>
                            <h2><?php print($array_kaartje["tekst"]); ?></h2>
                            <h3 class="<?php print($array_kaartje["geslacht"]); ?>_tekst"><?php print($array_kaartje["datum"]); ?></h3>
                    	</p>
                    	<a href="#" class="button right <?php  print($array_kaartje["geslacht"]); ?>_button">Kaartje bekijken</a>
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
                    	<p class="right">
								<input name="zoeken" type="submit" value="Uitloggen" class="button logout" onClick="window.location='http://tmtg11.ict-lab.nl/website/account.php?uitloggen=ja'"/><br/>
								<input name="zoeken" type="submit" value="Account pagina" class="button <?php print $geslacht ?>_button" /><br/>
								<input name="zoeken" type="submit" value="Kaartje toevoegen" class="button <?php print $geslacht ?>_button" />
						<p>
                        	<h1 class="<?php print $geslacht ?>_tekst">Gegevens</h1>
                            <h2>Vul informatie hieronder aan, leeg gelaten velden worden niet bijgewerkt</h2>
                            <form method="post" action="account.php">
                            	<table>
                                	<tr>
                                        <td><input name="naam" type="text" placeholder="Naam <?php if(isset($array["Voornaam"])){print(" : ".$array["Voornaam"]." ".$array["Tussenvoegsel"]." ".$array["Achternaam"]);}?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><input name="email" type="text" placeholder="E-mail adres <?php if(isset($array["Email"])){print(" : ".$array["Email"]);}?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><input name="woonplaats" type="text" placeholder="Woonplaats <?php if(isset($array["Woonplaats"])){print(" : ".$array["Woonplaats"]);}?>" /></td>
                                    </tr>
									<tr>
                                        <td><input name="provincie" type="text" placeholder="Provincie <?php if(isset($array["Provincie"])){print(" : ".$array["Provincie"]);}?>" /></td>
                                    </tr>
									<tr>
                                        <td><input name="geboortedatum" type="text" placeholder="Geboortedatum <?php if(isset($array["Geboortedatum"])){print(" : ".$array["Geboortedatum"]);}?>" /></td>
                                    </tr>
									<tr>
                                        <td><input name="email" type="text" placeholder="Email <?php if(isset($array["Email"])){print(" : ".$array["Email"]);}?>" /></td>
                                    </tr>
									<tr>
                                        <td><input name="geslacht" type="text" placeholder="Geslacht <?php if(isset($array["Geslacht"])){print(" : ".$array["Geslacht"]);}?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><textarea name="bericht" cols=25 rows="6" maxlength="750"  placeholder="Uw bericht...<?php if(isset($array["Vrije Tekst"])){print(" : ".$array["Vrije Tekst"]);}?>"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><input name="update" type="submit" value="Update uw account" class="button <?php print $geslacht ?>_button" /></td>
                                    </tr>
                                </table>
                            </form>
                        </p>
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