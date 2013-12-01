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
07-11-2013 - Mies : Logscript.
11-11-2013 - Maarten en Andre : Aanmaak pagina, aanmaak CSS, velen divs gemaakt.
12-11-2013 - Maarten en Andre : Header & searchbalk.
13-11-2013 - Maarten : Verder gegaan aan de vormgeving.
18-11-2013 - David: Social Media script toegevoegd en email verzonden
19-11-2013 Mies uitschakelen loggerscript IVM problemen met head en body (knees & Toes).
26-11-2013 David: Laatste Jongens en meisje laten zien
*/

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   		<title>Babies | Babyberichten.nl</title>
        
        <link rel="icon" href="<?php print(favicon("link")); ?>" type="img/logo/x-icon"/> 
		<link rel="shortcut icon" type="image/ico" href="<?php print(favicon("link")); ?>"/>
        
        <link rel="stylesheet" type="text/css" href="css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
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
            
            <!-- KAARTJES -->
            <div class="kaartjesnummer1 <?php print $geslacht ?>_achtergrond_opacity">
            	<div class="wrapper">
                	<h4>Laatst geboren</h4>
					
					<?php $array_eennalaatste = eennalaatste_kaartje(); ?>
	            	<div id="post_header" class="<?php print($array_eennalaatste["geslacht"]); ?>_border right">
                    	<p>
                        	<h1 class="<?php print($array_eennalaatste["geslacht"]); ?>_tekst"><?php print($array_eennalaatste["naam"]) . " "; print($array_eennalaatste["tussenvoegsel"]) . " "; print($array_eennalaatste["achternaam"]); ?></h1>
                            <h2><?php print($array_eennalaatste["tekst"]); ?></h2>
                            <h3 class="<?php print($array_eennalaatste["geslacht"]); ?>_tekst"><?php print($array_eennalaatste["datum"]); ?></h3>
                    	</p>
                    	<a href="#" class="button right <?php  print($array_eennalaatste["geslacht"]); ?>_button">Kaartje bekijken</a>
                    </div> <!-- Einde post_header -->
                    
					<?php $array_laatste = laatste_kaartje(); ?>
                    <div id="post_header" class="<?php print($array_laatste["geslacht"]); ?>_border">
                    	<p>
                        	<h1 class="<?php print($array_laatste["geslacht"]); ?>_tekst"><?php print($array_laatste["naam"]) . " "; print($array_laatste["tussenvoegsel"]) . " ";  print($array_laatste["achternaam"]); ?></h1>
                            <h2><?php print($array_laatste["tekst"]); ?></h2>
                            <h3 class="<?php print($array_laatste["geslacht"]); ?>_tekst"><?php print($array_laatste["datum"]); ?></h3>
                    	</p>
                    	<a href="#" class="button right <?php  print($array_laatste["geslacht"]); ?>_button">Kaartje bekijken</a>
                    </div> <!-- Einde post_header -->
                    
            	</div> <!-- Einde wrapper -->
            </div> <!-- Einde kaartjes -->
            
            <!-- KAARTJES -->
            <div class="kaartjesnummer2">
            	<div class="wrapper">
                	<h4 class="<?php print $geslacht ?>_tekst">Laatst toegevoegd</h4>
					
					<?php $array_eennalaatsttoegevoegd = eennatoegevoegdlaatste_kaartje(); ?>
                	<div id="post_header" class="<?php print($array_eennalaatsttoegevoegd["geslacht"]); ?>_border right">
                    	<p>
							<h1 class="<?php print($array_eennalaatsttoegevoegd["geslacht"]); ?>_tekst"><?php print($array_eennalaatsttoegevoegd["naam"]) . " "; print($array_eennalaatsttoegevoegd["tussenvoegsel"]) . " "; print($array_eennalaatsttoegevoegd["achternaam"]); ?></h1>
                            <h2><?php print($array_eennalaatsttoegevoegd["tekst"]); ?></h2>
                            <h3 class="<?php print($array_eennalaatsttoegevoegd["geslacht"]); ?>_tekst"><?php print($array_eennalaatsttoegevoegd["datum"]); ?></h3>
                    	</p>
                    	<a href="#" class="button right <?php  print($array_eennalaatsttoegevoegd["geslacht"]); ?>_button">Kaartje bekijken</a>
					</div> <!-- Einde post_header -->
                    
					<?php $array_laatsttoegevoegd = toegevoegdlaatste_kaartje(); ?>
                    <div id="post_header" class="<?php print($array_laatsttoegevoegd["geslacht"]); ?>_border">
                    	<p>
							<h1 class="<?php print($array_laatsttoegevoegd["geslacht"]); ?>_tekst"><?php print($array_laatsttoegevoegd["naam"]) . " "; print($array_laatsttoegevoegd["tussenvoegsel"]) . " "; print($array_laatsttoegevoegd["achternaam"]);?></h1>
                            <h2><?php print($array_laatsttoegevoegd["tekst"]); ?></h2>
                            <h3 class="<?php print($array_laatsttoegevoegd["geslacht"]); ?>_tekst"><?php print($array_laatsttoegevoegd["datum"]); ?></h3>
                    	</p>
                    	<a href="#" class="button right <?php  print($array_laatsttoegevoegd["geslacht"]); ?>_button">Kaartje bekijken</a>
                    </div> <!-- Einde post_header -->
                    
            	</div> <!-- Einde wrapper -->
            </div> <!-- Einde kaartjes -->
            
            <!-- KAARTJES -->
            <div class="kaartjesnummer3">
            	<div class="wrapper">
                	<h4>Laatste meisje &amp; jongen</h4>
					
	            	<?php $array_jongen = laatste_jongen(); ?>
                    <div id="post_header" class="<?php print($array_jongen["geslacht"]); ?>_border right">
                    	<p>
                        	<h1 class="<?php print($array_jongen["geslacht"]); ?>_tekst"><?php print($array_jongen["naam"]) . " "; print($array_jongen["tussenvoegsel"]) . " "; print($array_jongen["achternaam"]); ?></h1>
                            <h2><?php print($array_jongen["tekst"]); ?></h2>
                            <h3 class="<?php print($array_jongen["geslacht"]); ?>_tekst"><?php print($array_jongen["datum"]); ?></h3>
                    	</p>
                    	<a href="#" class="button right <?php  print($array_jongen["geslacht"]); ?>_button">Kaartje bekijken</a>
                    </div> <!-- Einde post_header -->
                    
					<?php $array_meisje = laatste_meisje(); ?>
					<div id="post_header" class="<?php print($array_meisje["geslacht"]); ?>_border">
                    	<p>
                        	<h1 class="<?php print($array_meisje["geslacht"]); ?>_tekst"><?php print($array_meisje["naam"]) . " "; print($array_meisje["tussenvoegsel"]) . " "; print($array_meisje["achternaam"]); ?></h1>
                            <h2><?php print($array_meisje["tekst"]); ?></h2>
                            <h3 class="<?php print($array_meisje["geslacht"]); ?>_tekst"><?php print($array_meisje["datum"]); ?>3</h3>
                    	</p>
                    	<a href="#" class="button right <?php  print($array_meisje["geslacht"]); ?>_button">Kaartje bekijken</a>
                    </div> 
                    <!-- Einde post_header -->
                    
            	</div> <!-- Einde wrapper -->
            </div> <!-- Einde kaartjes -->
                    
            <!-- CONTENT -->
            <div class="content">
            	<div class="wrapper">
					<div class="padding"></div>
						<div class="image right">
							<img src="img/background_header.png"/>
						</div> <!-- Einde image -->
						<div class="blok">
							<p>
								<h1 class="<?php print $geslacht ?>_tekst">Babies pagina</h1>
								<h2>Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. passages van Lorem Ipsum beschikbaar maar het.</h2>
								</p>
						</div> <!-- Einde blok -->
							<hr class="line">
						<div class="blok right">
							<p>
								<h1 class="<?php print $geslacht ?>_tekst">Babies pagina</h1>
								<h2>Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het. passages van Lorem Ipsum beschikbaar maar het.</h2>
							</p>
						</div> <!-- Einde blok -->
					
						<div class="image">
							<img src="img/background_header.png"/>
						</div> <!-- Einde image -->
					<div class="padding"></div>
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