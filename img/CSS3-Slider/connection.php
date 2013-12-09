<?php
/*
Changelog : 
Mies 18-11-2013 - $tabelbabykaartjes aangeven in connection.php, REALLY?!
*/

// -- Made By ICT-LAB
$host = "127.0.0.1";
$gebruiker_mysql = "tmtg11";
$wachtwoord2 = "smnea1";
$DBNaam = "dbtmtg11";

$Verbinding = mysql_connect("$host", "$gebruiker_mysql", "$wachtwoord2") or die("<p>De verbinding met de database kan niet worden gemaakt</p>" . mysql_error());
mysql_select_db($DBNaam) or die("<p>De database kan niet geselecteerd worden</p>");
?>
