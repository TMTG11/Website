<?php
session_start();
//LOGGERSCIPT 7-11-2013 Mies
include("whitelist.php");
$log = "Echten Site : ".date("Y-m-d H:i:s")." ".$_SERVER['REMOTE_ADDR']."\n";//Voeg variabelen toe VOOR de \n, dan komen ze in de log file. 
if(in_array($_SERVER['REMOTE_ADDR'],$whitelist)){
	$succes="U word niet gevolgd";	
}else{
	file_put_contents("../database/log.txt",$log, FILE_APPEND | LOCK_EX);
}
/*
Changelog : 
7-11-2013 - Mies : Aanmaak pagina, aanmaak CSS, logscript, velen divs gemaakt
*/
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Babyberichten.nl | Groep G | Grafisch Lyceum Rotterdam | Leerjaar 2013-2014</title>
</head>
<body>
<div id='wrapper'><!--wrapper-->
	
	<div id='header'><!--header-->
    	<div id='menu'><!-- blauwe balk boven knoppen -->
    	</div><!--menu-->
		<h1>is de startpagina voor Babyberichten.nl</h1>
	</div><!--header-->
    <div id='slider'><!--slider-->
    	<img src='http://71989.ict-lab.nl/slider.png'><!--Fucking windows wil niet naar thema map-->
    </div><!--slider-->
	<div id='content'><!--content-->
    <?php
			print($succes);
		?>
		<iframe src="http://www.dumpert.nl/embed/272681/e2a6253f/" width="480" height="368" class="dumpertembed" frameborder="0"></iframe>
	</div><!--content-->
    <div id='footer'><!--footer-->
    	<strong>
    	Copyright - TMTGT1000<br/>
        Maarten Paauw - Mies van der Lippe - David de Wit - Andre Dongen
        </strong>
    </div><!--footer-->
</div><!--wrapper-->

</body>
</html>
