<?php
$to = "user@ict-lab.nl";
$subject = "Contact";
$message = "Hallo, uw email is verzonden en wij zullen zo snel mogelijk contact met u opnemen. ";
$from = "contact@babyberichten.nl";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>contact_verwerk</title>
</head>

<body>

</body>
</html>
