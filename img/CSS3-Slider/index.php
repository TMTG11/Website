<?php
session_start();
//LOGGERSCIPT 7-11-2013 Mies
include("whitelist.php");
$log = "Echten Site : ".date("Y-m-d H:i:s")." ".$_SERVER['REMOTE_ADDR']."\n";//Voeg variabelen toe VOOR de \n, dan komen ze in de log file. 
if(in_array($_SERVER['REMOTE_ADDR'],$whitelist)){
	$succes="U word niet gevolgd";	
}else{
	file_put_contents("../database/log.php",$log, FILE_APPEND | LOCK_EX);
}

/*
Changelog : 
07-11-2013 - Mies : Logscript.
11-11-2013 - Maarten en Andre : Aanmaak pagina, aanmaak CSS, velen divs gemaakt.
12-11-2013 - Maarten en Andre : Header & searchbalk.
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   		<title>Home</title>
        <link rel="stylesheet" type="text/css" href="css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    
    <body>
    	<div id="container"> 
    	  	<!-- MENU -->
        	<div id="menu">
				<div class="wrapper">
                    <!-- LOGO -->
					<div id="logo">
						<a href="#"><img src="img/logo_blauw.png" width="256" height="63" alt="Logo" /></a>
					</div> <!-- Einde logo -->
                    <!-- MENU ITEMS -->
					<div id="menu_items">
						<ul>
							<li><a href="#" class="current_active">Home</a></li>
							<li><a href="#">Over ons</a></li>
							<li><a href="#">Babies</a></li>
							<li><a href="#">Inloggen</a></li>
						</ul>
					</div> <!-- Einde menu_items -->		
					<div id="menu_button">
						<a href="#" class="button">registreren</a>
					</div> <!-- Einde menu_button -->		
				</div> <!-- Einde wrapper -->
            </div> <!-- Einde menu -->
           
            <!-- HEADER -->
            <div id="header">
            <div id="content-slider"><!--begin content slider-->
    	<div id="slider"><!--begin slider-->
        	<div id="slideshow-wrap"><!--begin slideshow wrap-->
            	<input type="radio" id="button-1" name="controls" checked="checked"/>
                <label for="button-1"></label>
                <input type="radio" id="button-2" name="controls"/>
                <label for="button-2"></label>
                <input type="radio" id="button-3" name="controls"/>
                <label for="button-3"></label>
            </div><!-- end slideshow wrap-->
        	<div id="img"><!--begin img-->
                <ul>
                <li id="first" class="firstanimation">
                <a href="#">
                <img src="images/img_1.jpg" alt="Cougar"/>
                </a>
                <div class="tooltip"><!--begin tooltip/extra window-->
                <h1>Cougar</h1>
                </div><!--end tooltip/extra window-->
                </li>
    
                <li id="second" class="secondanimation">
                <a href="#">
                <img src="images/img_2.jpg" alt="Lions"/>
                </a>
                <div class="tooltip"><!--begin tooltip/extra window-->
                <h1>Lions</h1>
                </div><!--end tooltip/extra window-->
                </li>
                
                <li id="third" class="thirdanimation">
                <a href="#">
                <img src="images/img_3.jpg" alt="Snowalker"/>
                </a>
                <div class="tooltip"><!--begin tooltip/extra window-->
                <h1>Snowalker</h1>
                </div><!--end tooltip/extra window-->
                </li>
                            
                <li id="fourth" class="fourthanimation">
                <a href="#">
                <img src="images/img_4.jpg" alt="Howling"/>
                </a>
                <div class="tooltip"><!--begin tooltip/extra window-->
                <h1>Howling</h1>
                </div><!--end tooltip/extra window-->
                </li>
                            
                <li id="fifth" class="fifthanimation">
                <a href="#">
                <img src="images/img_5.jpg" alt="Sunbathing"/>
                </a>
                <div class="tooltip"><!--begin tooltip/extra window-->
                <h1>Sunbathing</h1>
                </div><!--end tooltip/extra window-->
                </li>
                </ul>
            </div><!--end img-->
            <div class="progress-bar"><!--begin progress bar-->
            </div><!--end progress bar-->
        </div><!--end slider-->
    </div><!--end content slider-->
            	<div class="wrapper">
                	<div id="post_header">
                    	<p>
                        	<h1>Maarten Paauw</h1>
                            <h2>Hier komt de tekst over de baby.</h2>
                            <h3>31-12-2013</h3>
                    	</p>
                    </div> <!-- Einde post_header -->
                    	<a href="#" class="button">Kaartje</a> 
                </div> <!-- Einde wrapper -->
            </div> <!-- Einde header -->
            
            <!-- SEARCH -->
            <div id="search">
            	<div class="wrapper">
                	<form>
                    	<table border="0" width="100%">
                        	<tr>
                            	<td width="250">
                                    <select name="cars">
                                        <option value="volvo">Volvo</option>
                                        <option value="saab">Saab</option>
                                        <option value="fiat">Fiat</option>
                                        <option value="audi">Audi</option>
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
            <div id="content">
            	<div class="wrapper">
                	<div class="blok_1">
                    	<p>
                        	<h1>Index pagina</h1>
                            <h2>Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het merendeel heeft te lijden gehad van wijzigingen in een of andere vorm, door ingevoegde humor of willekeurig gekozen woorden die nog niet half geloofwaardig ogen. Als u een passage uit Lorum Ipsum gaat gebruiken dient u zich ervan te verzekeren dat er niets beschamends midden in de tekst verborgen zit. Alle Lorum Ipsum generators op Internet hebben de eigenschap voorgedefinieerde stukken te herhalen waar nodig zodat dit de eerste echte generator is op internet. Het gebruikt een woordenlijst van 200 latijnse woorden gecombineerd met een handvol zinsstructuur modellen om een Lorum Ipsum te genereren die redelijk overkomt. De gegenereerde Lorum Ipsum is daardoor altijd vrij van herhaling, ingevoegde humor of ongebruikelijke woorden etc.</h2>
                        </p>
                    </div>
                </div> <!-- Einde wrapper -->
            </div> <!-- Einde content -->
        </div> <!-- Einde container -->
    </body>
</html>