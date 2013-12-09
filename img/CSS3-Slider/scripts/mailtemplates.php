<?php
/*
Hierin eventuele mails
Schrijf de mail uit, gebruik of algemene variablen of heel unieke variabelnamen.

Changelog : 
18-11-2013 David Schrijven van de mails.
19-11-2013 Mies Aanmaak mails in appart bestand.

*/
//Bericht voor de klant
$klantmail = "Hallo $naamvraagsteller,

Uw email is succesvol verzonden!
Wij zullen zo snel mogelijk uw vraag in behandeling nemen.

Met vriendelijke groet,

babyberichten.nl ";

//bericht voor administrator
$adminbericht= "Hallo,

Er is zojuist een contact aanvraag gedaan op babyberichten.nl door $naamvraagsteller.

Hier zijn alle gegevens van deze aanvraag op een rij:

Ip adres:
$ipadres

Tijd en datum:
$datum

Naam:
$naamvraagsteller

Email adres:
$emailvraagsteller

Telefoonnummer:
$telefoonvraagsteller

Bericht:
$berichtvraagsteller

Dit was een geautomatiseerd bericht vanaf babyberichten.nl
Dit bericht is alleen voor de administrator bedoeld!";

?>