<?php
//session_start();
//include("../connection.php");

/*
TO DO :
Random salt in database.
Opmaak.
Nieuw Logscript
Sessions

Changelog :
11-11-2013 Mies Aanmaak pagina, aanmaak tabellen
12-11-2013 Mies begin PHP Scripts, Encryptie wachtwoorden, MYSQL queries enzo
14-11-2013 Mies begin e-mail activatie (ZIE OOK VERIFICATIE.PHP)
18-11-2013 Mies extra comments, meer vriendelijke foutmeldingen, voorbereidingen uiteindelijke inlogpagina (foutmeldingen enzo). Titel, favicon. <head> ip <header> >.<
18-11-2013 Mies & Maarten - Stijl :D
19-11-2013 Mies Meldingen
19-11-2013 Maarten HTML en Stijl
19-11-2013 Mies Kleur meldingen ding.
19-11-2013 Mies uitschakelen loggerscript IVM problemen met head en body (knees & Toes).

Changelog voor stijl van pagina :

*/
//afvangen login button
if(isset($_POST['login'])){
	//Dev only - Mies 12-11-2013 
	$foutmeldingen[]="Login button gevonden";
	$foutmeldingen[]="Email : ".$_POST['email'];
	$foutmeldingen[]="Wachtwoord : ".$_POST['wachtwoord'];
	
	//Controle op lege velden - Mies 12-11-2013
	if(empty($_POST['email'])){
		$alert = $alert." Naam Leeg <br/>";
		$class = "negatief";
	}
	if(empty($_POST['wachtwoord'])){
		$alert = $alert." Wachtwoord Leeg <br/>";
		$class = "negatief";
	}
	
	//Inlog beveiligingen - Mies 12-11-2013
	$password = mysql_real_escape_string($_POST['wachtwoord']);
	$email    = mysql_real_escape_string($_POST['email']);
	//Salt
	$salt ="354t9r0hq12bjklrnfiljkdbnrgtiu34b";
	$escapedPW= $password;
	$saltedPW = $escapedPW . $salt;
	$hashedPW = hash('sha256', $saltedPW);
	
	//Login - Mies 12-11-2013
	$opdracht = mysql_query("SELECT * FROM gebruiker WHERE Email = '$email' AND Wachtwoord= '$hashedPW' AND IsVerified='1'");
	if($opdracht){
		$array=mysql_fetch_array($opdracht);
		if(count($array)>1){
			$alert = $alert."Gebruiker gevonden<br/>";
			$class = "positief";
		}else{
			$alert = $alert."Gebruiker niet gevonden. Heeft U uw account al geactiveerd? Zie e-mail voor activatie link<br/>";
			$class = "negatief";
		}
	}else{
		$foutmeldingen[]="MySQL fout".mysql_error();
		$alert = $alert."Er is hellaas iets fout gegaan in ons systeem. De fout is vastgelegd in de logs. <br/>";
	}	
}
//afvangen registreer button
if(isset($_POST['registreer'])){
	//Dev only - Mies 12-11-2013
	$foutmeldingen[]="Registreer button gevonden";
	$foutmeldingen[]="Naam : ".$_POST['naam'];
	$foutmeldingen[]="Email : ".$_POST['email'];
	$foutmeldingen[]="Wachtwoord : ".$_POST['wachtwoord'];

	//Controle op lege velden - Mies 12-11-2013
	$maginserten = "true";
	if(empty($_POST['email'])){
		$alert = $alert." Email Leeg <br/>";
		$class = "negatief";
		$maginserten = "false";
	}
	if(empty($_POST['wachtwoord'])){
		$alert = $alert." Wachtwoord Leeg <br/>";
		$maginserten = "false";
		$class = "negatief";
	}
	//EMAIL CHECK - Mies 14-11-2013
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$alert = $alert." Foutief e-mail adres ingevoerd<br/>";
		$maginserten = "false";
		$class = "negatief";
	}

	//Registratie beveiligingen - Mies 12-11-2013
	$voornaam = mysql_real_escape_string($_POST['naam']);
	$password = mysql_real_escape_string($_POST['wachtwoord']);
	$email    = mysql_real_escape_string($_POST['email']);
	$salt ="354t9r0hq12bjklrnfiljkdbnrgtiu34b";
	$escapedPW= $password;
	$saltedPW = $escapedPW . $salt;
	$hashedPW = hash('sha256', $saltedPW);
	//Check of gebruiker al bestaat - Mies 14-11-2013
	$gebruikercheck = mysql_query("SELECT * FROM gebruiker WHERE Email='$email'");
	$checkemail = mysql_fetch_array($gebruikercheck);
	if(count($checkemail) > 1){
		$maginserten = "false";
		$class = "negatief";
		$alert = $alert." Er bestaat al een gebruiker met dit E-mail adres <br/>";
	}
	//Insert - Mies 12-11-2013
	//Email systeem - Mies 14-11-2013
	if($maginserten=="true"){
		$activatiecode = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
		$opdracht = mysql_query("INSERT INTO gebruiker (Voornaam, Wachtwoord, Email, IsVerified, VerificatieCode) VALUES ('$voornaam', '$hashedPW', '$email','0','$activatiecode')");
		//MySQL
		if($opdracht){			
			$foutmeldingen[]="Account Insert is gelukt";
			$insertlog = " Succesvol geinsert".$opdracht;
			//EMAIL			
			//Headers, bericht.
			$subject = 'TMTG11 - Activatie Account';
			$message = 'Hallo '.$voornaam.'. Om uw account te activeren, klik hier : http://tmtg11.ict-lab.nl/website/verificatie.php?code='.$activatiecode.'&email='.$email;
			$headers   = array();
				$headers[] = "MIME-Version: 1.0";
				$headers[] = "Content-type: text/plain; charset=iso-8859-1";
				$headers[] = "From: No Reply <noreply@ict-lab.nl>";
				$headers[] = "Reply-To: No Reply <noreply@ict-lab.nl>";
				$headers[] = "Subject: {$subject}";
				$headers[] = "X-Mailer: PHP/".phpversion();
			//versturen mail
			mail('tmtg11@ict-lab.nl', $subject, $message, implode("\r\n", $headers));
			$alert = $alert." U bent succesvol toegevoegd aan onze database. Een e-mail is verstuurd naar : ".$email.". Om uw account te gebruiken verzoeken wij U om op de in uw link te klikken<br/>";
			$class = "positief";
		}else{
			$foutmeldingen[]=mysql_error();
			$insertlog = " Fout bij insert ".mysql_error()." Query : ".$opdracht;
			$alert = $alert." Er is helaas een fout opgetreden. De fout is vastgelegd in onze logs.<br/>";
			$class = "negatief";
		}
	}else{
		$alert = $alert." Gebrekkige gegevens. Vul AUB alle velden correct in en probeer het opnieuw.<br/>";
		$class = "negatief";
	}
}
//ALS ER GEEN ALERTS ZIJN WORD DE VOLGENDE TEKST WEERGEGEVEN
if(!isset($alert)){
	$alert = "Welkom op de inlogpagina van Babyberichten.nl Hier kunt u inloggen en registeren.";
	$class = "normaal";
}

//LOGGERSCIPT 7-11-2013 Mies
/*
include("whitelist.php");
if(isset($_POST['login'])){
	$gegevens="Poging tot login - Naam : ".$_POST['naam']." Wachtwoord : ".$hashedPW;
}
if(isset($_POST['registreer'])){
	$gegevens="Poging tot registratie - Naam : ".$_POST['naam']." Email : ".$_POST['email']." Wachtwoord : ".$hashedPW.$insertlog;
}
$log = "Echten Site : ".date("Y-m-d H:i:s")." "." LOGIN PAGINA ".$gegevens."\n";//Voeg variabelen toe VOOR de \n, dan komen ze in de log file. 
if(in_array($_SERVER['REMOTE_ADDR'],$whitelist)){
	$succes="U word niet gevolgd";	
}else{
	file_put_contents("database/log.".$_SERVER['REMOTE_ADDR'].".php",$log, FILE_APPEND | LOCK_EX);
}
*/
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
						<a href="index.php"><img src="img/logo/logo_blauw.png" width="256" height="63" alt="Logo" /></a>
					</div> <!-- Einde logo -->
                    <!-- MENU ITEMS -->
					<div id="menu_items">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="overons.php">Over ons</a></li>
							<li><a href="babies.php">Babies</a></li>
							<li><a href="login.php" class="current_active">Inloggen</a></li>
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
        
		<!-- KAARTJES -->
            <div class="kaartjes">
            	<div class="wrapper">
	            	<div id="post_header_inlog" class="right">
                    	<h1>Registreren</h1> 
							<h2>Text over Registreren op de site</h2>
							<form name='registratieform' method='post'><!--Begin RegistratieForumulier - Mies 12-11-2013-->
								<table id='tabel'>
									<tr>
										<td><input type='text'name='naam' placeholder="Voornaam"/></td>
									</tr>
									<tr>
										<td><input type='password' name='wachtwoord' placeholder="Wachtwoord"/></td>
									</tr>
									<tr>
										<td><input type='text' name='email' placeholder="E-mail adres"/></td>
									</tr>
									<tr>
										<td><input type='submit' name='registreer' value='Registreer' class="button"/></td>
									</tr>
								</table>
							</form><!--Einde RegistratieForumulier - Mies 12-11-2013-->
                    </div> <!-- Einde post_header -->
                    
                    <div id="post_header_inlog">
                    	<form name='inlogform' method='post'>
							<h1>Inloggen</h1> 
							<h2>Text over Inloggen op de site</h2>
							<table id='tabel'>
								<tr><!--Begin InlogForumulier - Mies 12-11-2013-->
									<td><input type='text' name='email' placeholder="E-mail adres"/></td>
								</tr>
								<tr>
									<td><input type='password' name='wachtwoord' placeholder="Wachtwoord"/></td>
								</tr>
								<tr>
									<td height="67">&nbsp;</td>
								</tr>
								<tr>
									<td><input type='submit' name='login' value='Login' class="button"/></td>
								</tr>
							</table><!--Einde InlogForumulier- Mies 12-11-2013-->
						</form>
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