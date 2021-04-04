<?php
$Host = "localhost";
$User = "root";
$Passwd = "";
$DBName= "workers";
$Connect= mysql_connect($Host, $User, $Passwd, $DBName);
mysql_query("use workers");
mysql_set_charset("utf8");
?>
