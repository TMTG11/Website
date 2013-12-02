<?php

$link1 = mysql_connect("127.0.0.1", "geonl", "geonl");
mysql_select_db("dbgeonl", $link1);

$link2 = mysql_connect("127.0.0.1", "01234", "mijnwachtw");
mysql_select_db("db01234", $link2);

$result = mysql_query("SELECT * FROM `province`", $link1);

echo $result;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>