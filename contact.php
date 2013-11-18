<!--Andre Dongen - contact form HTML 18-11-2013]-->
<!--David de Wit - contact form PHP [18-11-2013]-->
<?php
if (!empty($_POST)){
	if(!empty($_POST["naam"]) && ($_POST["email"]) && ($_POST["telefoon"]) && ($_POST["bericht"])){
	$naam = mysql_real_escape_string ($_POST["naam"]);
	$email = mysql_real_escape_string ($_POST["email"]);
	$telefoon = mysql_real_escape_string ($_POST["telefoon"]);
	$bericht = mysql_real_escape_string ($_POST["bericht"]);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>contact</title>
</head>
<body>
<form name="contactform" method="post" action="contact_verwerk.php">
<table width="450px">
<tr>
 <td valign="top">
  <label for="naam">Naam:</label>
 </td>
 <td valign="top">
  <input  type="text" name="naam" maxlength="50" size="30">
 </td>
</tr>
<tr>
  <td valign="top">
    <label for="email">Email:</label>
    </td>
  <td valign="top">
    <input  type="text" name="email" maxlength="80" size="30">
    </td>
</tr>
<tr>
  <td valign="top">
    <label for="telefoon">Telefoon:</label>
    </td>
  <td valign="top">
    <input  type="text" name="telefoon" maxlength="50" size="30">
    </td>
</tr>
<tr>
  <td valign="top">
    <label for="bericht">Bericht:</label>
    </td>
  <td valign="top">
    <textarea  name="bericht" maxlength="144" cols="25" rows="6"></textarea>
    </td>
</tr>
<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" value="Submit">
 </td>
</tr>
</table>
</form>
</body>
</html>