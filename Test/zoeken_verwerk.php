<?php
require ("connection.php");

$_REQUEST['search'];//Type Zoekopdacht naam/woonplaats etc
$voornaamzoeken = $_REQUEST['zoekopdracht'];//De precieze naam of plaats die gezocht word

$tabelnaam="kaartjes";
$opdracht = "SELECT * FROM $tabelnaam";
//Zoekt op soortgelijke Voornaam
$opdracht = "SELECT * FROM $tabelnaam WHERE Voornaam LIKE '%$voornaamzoeken%'";
$result = mysql_query($opdracht);
//Zet de tabel klaar
echo ("<TABLE width=100% border=1>");
while ($Rij = mysql_fetch_array($result)){
		
echo "<tr>";
echo ("<td> $Rij[PostID] </td>\n");
echo ("<td> $Rij[GebruikersID] </td>\n");
echo ("<td> $Rij[Voornaam] </td>\n");
echo ("<td> $Rij[Tussenvoegsel] </td>\n");
echo ("<td> $Rij[Achternaam] </td>\n");
echo ("<td> $Rij[Geboortegewicht] </td>\n");
echo ("<td> $Rij[Geboortedatum] </td>\n");
echo ("<td> $Rij[Geboorteplaats] </td>\n");
echo ("<td> $Rij[Geslacht] </td>\n");
echo ("<td> $Rij[VrijTekst] </td>\n");
echo ("</tr>\n");
		
}
//Laat de tabel zien
echo "<br><br>";
echo ("</TABLE>");

mysql_free_result($result);
mysql_close ($verbinding);
?>