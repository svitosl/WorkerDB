<!DOCTYPE HTML>
<meta charset="UTF-8">
<html>
<head>
	<title>Работа по БД</title>
</head>

<body>
<br><font size="5">Выбор таблицы:</font><br>
<br>< <a href="index.php">Зарплата рабочего</a> | <a href="workshop.php">Цехи</a> | <a href="titles.php">Должности</a> | <u>Разряды</u> ><br>
<br>
<table border="1" align="left" cellpadding="0">
<tr>
    <td align="center">ID</td>
    <td align="center">№ Разряда</td>
 </tr>

<?php
require_once("connect.php");
$data = mysql_query("SELECT * FROM `discharges`");

while (($mass_data = mysql_fetch_assoc($data)) != false)
{
    $str = "<tr>";
    $str .= "<td align=\"center\">".$mass_data["id_disch"]."</td>";
    $str .= "<td align=\"center\">".$mass_data["coff_disch"]."</td>";
    $str .= "</tr>";
    echo "$str";
}
echo "</table>";
for ($i=0; $i<mysql_num_rows($data); $i++) echo "<br><br>";
?>

Добавление разряда: <form action="" method="GET"><input type="text" name="discharges" placeholder="Название разряда" size="50">
<input type="submit" name="add" value="Добавить разряд">
    
<?php
if (isset($_GET["add"]))
{
    $result = mysql_query("INSERT INTO discharges (coff_disch) VALUES ('".$_GET["discharges"]."')");

    if ($result)
    {
        unset ($_GET);
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=discharges.php\">";
    }
    else echo "<br>Ошибка выполнения запроса к БД: ".mysql_error()."<br>";
}
?>

<br><br>Редактирование разряда:<br>
ID: <select name="combo_id">
<?php
$tmp = mysql_query("SELECT id_disch FROM discharges ORDER BY id_disch ASC");
while (($mass_string = mysql_fetch_assoc($tmp)) != false)
{
    echo "<option value = \"".$mass_string["id_disch"]."\">".$mass_string["id_disch"]."</option>";  
}
echo "</select>
<input type=\"text\" name=\"edit_value\" placeholder=\"Новое название разряда\" size=\"40\">
<input type=\"submit\" name=\"edit\" value=\"Редактировать\">";

if (isset($_GET["edit"]))
{
   $result = mysql_query("UPDATE discharges SET coff_disch = '".$_GET["edit_value"]."' WHERE id_disch = '".$_GET["combo_id"]."' LIMIT 1");

    if ($result)
    {
        unset ($_GET);
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=discharges.php\">";
    }
    else echo "<br>Ошибка выполнения запроса к БД: ".mysql_error()."<br>";
}
?>

<br><br>Удаление разряда:<br>
ID: <select name="combo_id2">
<?php
$tmp = mysql_query("SELECT id_disch FROM discharges ORDER BY id_disch ASC");
while (($mass_string = mysql_fetch_assoc($tmp)) != false)
{
    echo "<option value = \"".$mass_string["id_disch"]."\">".$mass_string["id_disch"]."</option>"; 
}
?>
</select>
<input type="submit" name="del" value="Удалить">

<?php
if (isset($_GET["del"]))
{
    $tmp = mysql_query("DELETE FROM discharges WHERE id_disch = '".$_GET["combo_id2"]."' LIMIT 1");
    if ($tmp) echo "<meta http-equiv=\"refresh\" content=\"0;URL=discharges.php\">";
    else echo "<br>Ошибка выполнения запроса ".mysql_error()."<br>";
}
?>
</form>
</body>
</html>