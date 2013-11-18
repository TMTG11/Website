<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Geboorteuitlezen index</title>
</head>

<body>

<?php
include ("connection.php");

//Limit bepaald het aantal baby's
$opdrachtbaby = "SELECT * FROM $tabelkaartjes ORDER BY PostID DESC limit 1";
      
	  //Voorbeeld van records die uit de tabel uitgelezen worden
      $result = mysql_query($opdrachtbaby);
      echo ("<TABLE width=100% align='center'; border=1>");
      echo "<tr>";
          echo ("<td>PostID</td>\n");
          echo ("<td>GebruikersID</td>\n");
		  echo ("<td>Achternaam</td>\n");
          echo ("<tr>\n");
      while ($Rij = mysql_fetch_array($result)){
          echo "<tr>";
          echo ("<td> $Rij[PostID] </td>\n");
          echo ("<td> $Rij[GebruikersID] </td>\n");
		  echo ("<td> $Rij[Achternaam] </td>\n");
          echo ("<tr>\n");
      }
      echo ("</TABLE>");
?>
</body>
</html>