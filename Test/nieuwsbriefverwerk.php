<?php
//Hier word een email verstuurt die de bezoeker duidelijk maakt dat deze zich voor de nieuwsbrief heeft geregistreerd
$to = "bezoeker@ict-lab.nl";
$subject = "Nieuwsbrief";
$message = "Hallo,

U heeft aangegeven onze nieuwsbrief te willen ontvangen.
Deze nieuwsbrief ontvangt u maximaal 1 keer per dag wanneer er nieuwe baby's geboren zijn in de door u aangewezen regio.

Wilt u de nieuwsbrief niet langer ontvangen?
Bezoek dan onze website op www.babyberichten.nl

Namens babyberichten.nl wensen wij u nog een fijne dag!";
$from = "nieuwsbrief@babyberichten.nl";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nieuwsbrief</title>
</head>

<body>



</body>
</html>
