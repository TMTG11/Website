<?php
/*
session_start();
include ("connection.php");

$GebruikersID = $_SESSION['GebruikersID'];
if ($_SESSION['type']=='GebruikersID')
{
	*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Uitlezen</title>
</head>

<body>
<?php
//Dit leesd de tabel uit van de juiste persoon en weergeeft deze
include ("connection.php");

$opdracht = "SELECT * FROM $tabelkaartjes";

$result = mysql_query($opdracht);
echo ("<TABLE width=90% border=1>");
echo ("<td>PostID</td>\n");
echo ("<td>GebruikersID</td>\n");
echo ("<td>Naam</td>\n");
echo ("<td>Tussenvoegsel</td>\n");
echo ("<td>Achternaam</td>\n");
echo ("<td>Gewicht</td>\n");
echo ("<td>Geboortedatum</td>\n");
echo ("<td>Plaats</td>\n");
echo ("<td>Geslacht:</td>\n");
echo ("<td>Eigen tekst:</td>\n");
echo ("<td>Afbeeldinglocatie:</td>\n");
echo ("<td>Provincie::</td>\n");
echo ("<td>Thema:</td>\n");

echo ("<tr>\n");

while ($Rij = mysql_fetch_array($result)){
	echo "<tr>";
	//alleen voor test, kan later weg gehaald worden
	echo ("<td> $Rij[PostID] </td>\n");
	echo ("<td> $Rij[GebruikersID] </td>\n");
	//
	echo ("<td> $Rij[Voornaam] </td>\n");
	echo ("<td> $Rij[Tussenvoegsel] </td>\n");
	echo ("<td> $Rij[Achternaam] </td>\n");
	echo ("<td> $Rij[Geboortegewicht] </td>\n");
	echo ("<td> $Rij[Geboortedatum] </td>\n");
	echo ("<td> $Rij[Geboorteplaats] </td>\n");
	echo ("<td> $Rij[Geslacht] </td>\n");
	echo ("<td> $Rij[VrijeTekst] </td>\n");
	echo ("<td> $Rij[Afbeeldingslocatie] </td>\n");
	echo ("<td> $Rij[Provincie] </td>\n");
	echo ("<td> $Rij[Thema] </td>\n");

echo ("<tr>\n");
}

echo ("</TABLE>");
mysql_free_result($result);
mysql_close ($Verbinding);
?>
</body>
</html>

<?php
/*
}
else{
	header ("Location: inloggen.php");
}
*/
?>