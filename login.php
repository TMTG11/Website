<?php
session_start();
include("../connection.php");

/*
Changelog :
11-11-2013 Mies - Aanmaak pagina, aanmaak stijl, aanmaak tabellen, aanmaak divs
12-11-2013 Mies begin PHP Scripts, Encryptie wachtwoorden, MYSQL queries enzo
14-11-2013 Mies begin e-mail activatie (ZIE OOK VERIFICATIE.PHP)
*/
if(isset($_POST['login'])){
	//Dev only - Mies 12-11-2013 
	$foutmeldingen[]="Login button gevonden";
	$foutmeldingen[]="Email : ".$_POST['email'];
	$foutmeldingen[]="Wachtwoord : ".$_POST['wachtwoord'];
	
	//Controle op lege velden - Mies 12-11-2013
	if(empty($_POST['email'])){
	$alert = $alert." Naam Leeg <br/>";
	}
	if(empty($_POST['wachtwoord'])){
		$alert = $alert." Wachtwoord Leeg <br/>";
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
			$foutmeldingen[]="Gebruiker gevonden";
		}else{
			$foutmeldingen[]="Gebruiker niet gevonden.";
		}
	}else{
		$foutmeldingen[]="Opgefokt";
	}	
}
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
		$maginserten = "false";
	}
	if(empty($_POST['wachtwoord'])){
		$alert = $alert." Wachtwoord Leeg <br/>";
		$maginserten = "false";
	}
	//EMAIL CHECK - Mies 14-11-2013
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$alert = $alert." Foutief e-mail adres ingevoerd<br/>";
		$maginserten = "false";
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
		$alert = $alert." Er bestaat al een gebruiker met dit E-mail adres <br/>";
	}
	//Insert - Mies 12-11-2013
	//Email systeem - Mies 14-11-2013
	if($maginserten=="true"){
		$activatiecode = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
		$opdracht = mysql_query("INSERT INTO gebruiker (Voornaam, Wachtwoord, Email, IsVerified, VerificatieCode) VALUES ('$voornaam', '$hashedPW', '$email','0','$activatiecode')");
		//MySQL
		if($opdracht){			
			$foutmeldingen[]="INSERT GELUKT <3";
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
		}else{
			$foutmeldingen[]=mysql_error();
			$insertlog = " Fout bij insert ".mysql_error()." Query : ".$opdracht;
			$alert = $alert." Er is helaas een fout opgetreden. Neem eventueel contact op met een Administrator <br/>";
		}
	}else{
		$insertlog = " Gebrekkige gegevens - geen insert ";
	}
}


//LOGGERSCIPT 7-11-2013 Mies
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

?>
<!DOCTYPE html>
<html>
<header>
<!-- Tijdelijk style sheet - Mies 12-11-2013 -->
<style>
#inloglinks{
	width:340px;
	border-style:dotted;
	float:left;
	padding:30px;
	padding-left:60px;
}
#inlogrechts{
	width:340px;
	border-style:dotted;
	float:left;
	padding:30px;
	padding-left:60px;
}
#tabel{
	border-style:solid;
	border:1px;
}


</style>
</header>
<body>
<!-- BEGIN INHOUD -->
<!--Begin Linker div - Mies 12-11-2013-->
<div id='inloglinks'>
	<form name='inlogform' method='post'>
		<h1>Inloggen</h1> 
		<p>Text over Inloggen op de site</p>
		<table id='tabel'>
			<tr><!--Begin InlogForumulier - Mies 12-11-2013-->
				<td>Emailadres </td><td><input type='text' name='email'/></td>
			</tr>
			<tr>
				<td>Wachtwoord</td><td><input type='password' name='wachtwoord'/></td>
			</tr>
			<tr>
				<td><td><input type='submit' name='login' value='Login'/></td>
			</tr>
		</table><!--Einde InlogForumulier- Mies 12-11-2013-->
	</form>
</div><!--Einde Linker div - Mies 12-11-2013-->


<!--Begin Rechter div - Mies 12-11-2013-->
<div id='inlogrechts'>
	<h1>Registreren</h1> 
	<p>Text over Registreren op de site</p>
	<form name='registratieform' method='post'><!--Begin RegistratieForumulier - Mies 12-11-2013-->
		<table id='tabel'>
			<tr>
				<td>Naam</td><td><input type='text'name='naam'/></td>
			</tr>
			<tr>
				<td>Wachtwoord</td><td><input type='password' name='wachtwoord'/></td>
			</tr>
			<tr>
				<td>E-mail Adres</td><td><input type='text' name='email'/></td>
			</tr>
			<tr>
				<td><td><input type='submit' name='registreer' value='Registreer'/></td>
			</tr>
		</table>
	</form><!--Einde RegistratieForumulier - Mies 12-11-2013-->
</div><!--Einde Rechter div - Mies 12-11-2013-->

Foutmeldingen : <br/><!-- DEVELOPMENT ONLY REMOVE BEFORE FLIGHT  - Mies 12-11-2013-->
<?php
	//WEGHALEN VOOR RELEASE - Mies 12-11-2013
	print_r($foutmeldingen);
	print("<br/>");
	
	print("<br/>");
	print_r($array);
	print("<br/>");
	print($alert);
	
?>
<!-- EINDE INHOUD -->
</body>
</html>