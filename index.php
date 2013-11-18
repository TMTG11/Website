<?php

session_start();
//LOGGERSCIPT 7-11-2013 Mies
include("whitelist.php");
$log = "Echten Site : ".date("Y-m-d H:i:s")." "."\n";//Voeg variabelen toe VOOR de \n, dan komen ze in de log file. 
if(in_array($_SERVER['REMOTE_ADDR'],$whitelist)){
	$succes="U word niet gevolgd";	
}else{
	file_put_contents("database/log.".$_SERVER['REMOTE_ADDR'].".php",$log, FILE_APPEND | LOCK_EX);
}
/*

Changelog : 
07-11-2013 - Mies : Logscript.
11-11-2013 - Maarten en Andre : Aanmaak pagina, aanmaak CSS, velen divs gemaakt.
12-11-2013 - Maarten en Andre : Header & searchbalk.
13-11-2013 - Maarten : Verder gegaan aan de vormgeving.
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
   		<title>Home | Babyberichten.nl</title>
		<link rel="shortcut icon" type="image/ico" href="img/logo/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head> 
    <body>
    	<div id="container"> 
    	  	<!-- MENU -->
        	<div id="menu">
				<div class="wrapper">
                    <!-- LOGO -->
					<div id="logo">
						<a href="#"><img src="img/logo/logo_blauw.png" width="256" height="63" alt="Logo" /></a>
					</div> <!-- Einde logo -->
                    <!-- MENU ITEMS -->
					<div id="menu_items">
						<ul>
							<li><a href="index.php" class="current_active">Home</a></li>
							<li><a href="overons.php">Over ons</a></li>
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
            
            <!-- KAARTJES -->
            <div class="kaartjes">
            	<div class="wrapper">
	            	<div id="post_header" class="right">
                    	<p>
                        	<h1>Maarten Paauw</h1>
                            <h2>Hier komt de tekst over de baby.</h2>
                            <h3>31-12-2013</h3>
                    	</p>
                    	<a href="#" class="button right">Kaartje</a>
                    </div> <!-- Einde post_header -->
                    
                    <div id="post_header">
                    	<p>
                        	<h1>Maarten Paauw</h1>
                            <h2>Hier komt de tekst over de baby.</h2>
                            <h3>31-12-2013</h3>
                    	</p>
                    	<a href="#" class="button right">Kaartje</a>
                    </div> <!-- Einde post_header -->
                    
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
					<div class="padding"></div>	
                </div> <!-- Einde wrapper -->
            </div> <!-- Einde content -->
            
            <!-- FOOTER -->
            <div id="footer">
            	<div class="wrapper">
	            		<div class="right">
	            			<p>
								<!--David 12-11-13 !-->
                                <a href="https://www.facebook.com/sharer/sharer.php?u=http://TMTG11.ict-lab.nl/website" target="_blank"><img src="img/social/facebook_white.png" width="40" /></a>&nbsp;
                                <a href="https://plusone.google.com/_/+1/confirm?hl=en&url=http://TMTG11.ict-lab.nl/website" target="_blank"><img src="img/social/google_white.png" width="40"/></a>&nbsp;
                                <a href="http://twitter.com/home?status=http://TMTG11.ict-lab.nl/website" target="_blank"><img src="img/social/twitter_white.png" width="40"/></a>&nbsp;
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