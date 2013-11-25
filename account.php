<?php 
/*
Changelog
25-11-2013 Mies Aanmaak Account.php Eerste scripts. Uitlogknop

*/
	session_start();
	require_once('scripts/inlogcheck.php');
	if(!$_SESSION["ingelogd"]){
		header('Location: http://tmtg11.ict-lab.nl/website/login.php');
	}
	if($_GET["uitloggen"]=="ja"){
		session_destroy();
		header('Location: http://tmtg11.ict-lab.nl/website/login.php');
	}
	$alert="<a href='http://tmtg11.ict-lab.nl/website/account.php?uitloggen=ja'>Uitloggen</a>";
	$array = $_SESSION["userinfo"];

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   		<title>Inloggen | Babyberichten.nl</title>
        
        <link rel="icon" href="img/logo/favicon.ico" type="img/logo/x-icon"/> 
		<link rel="shortcut icon" type="image/ico" href="img/logo/favicon.ico"/>
        
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
						<a href="index.php"><img src="<?php print(logo("link")); ?>" width="256" height="63" alt="Logo" /></a>
					</div> <!-- Einde logo -->
                    <!-- MENU ITEMS -->
					<div id="menu_items">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="overons.php">Over ons</a></li>
							<li><a href="babies.php">Babies</a></li>
							<li><a href="<?php print(inloggen_button("link")); ?>" class="current_active"><?php print(inloggen_button("tekst")); ?></a></li>
						</ul>
					</div> <!-- Einde menu_items -->		
					<div id="menu_button">
						<a href="<?php print(registreren_button("link")); ?>" class="button"><?php print(registreren_button("tekst")); ?></a>
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
            	<div id="account">
            		<div class="wrapper">
                    	<p class="right">
								<input name="zoeken" type="submit" value="Account pagina" class="button" /><br/>
								<input name="zoeken" type="submit" value="Kaartje toevoegen" class="button" />
						<p>
                        	<h1>Contactformulier</h1>
                            <h2>Hallo</h2>
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
            
            <!-- CONTENT -->
            <div class="content">
            	<div class="wrapper">
					<div class="padding"></div>
						<div class="image right">
							<img src="img/background_header.png"/>
						</div> <!-- Einde image -->
						<div class="blok">
							<?php print_r($array); ?>
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
    </body>
</html>

</body>
</html>