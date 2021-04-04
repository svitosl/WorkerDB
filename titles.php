<!DOCTYPE HTML>
<meta charset="UTF-8">
<html>
<head>
	<title>Работа по БД</title>
</head>

<body>
<br><font size="5">Выбор таблицы:</font><br>
<br>< <a href="index.php">Зарплата рабочего</a> | <a href="workshop.php">Цехи</a> | <u>Должности</u> | <a href="discharges.php">Разряды</a> ><br>
<br>
<table border="1" align="left" cellpadding="0">
<tr>
    <td align="center">ID</td>
    <td align="center">Название должности</td>
 </tr>

<?php
require_once("connect.php");
$data = mysql_query("SELECT * FROM `titles`");

while (($mass_data = mysql_fetch_assoc($data)) != false)
{
    $str = "<tr>";
    $str .= "<td align=\"center\">".$mass_data["id_title"]."</td>";
    $str .= "<td align=\"center\">".$mass_data["name_title"]."</td>";
    $str .= "</tr>";
    echo "$str";
}
echo "</table>";
for ($i=0; $i<mysql_num_rows($data); $i++) echo "<br><br>";
?>

Добавление должности: <form action="" method="GET"><input type="text" name="title" placeholder="Название должности" size="50">
<input type="submit" name="add" value="Добавить должность">
    
<?php
if (isset($_GET["add"]))
{
    $result = mysql_query("INSERT INTO titles (name_title) VALUES ('".$_GET["title"]."')");

    if ($result)
    {
        unset ($_GET);
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=titles.php\">";
    }
    else echo "<br>Ошибка выполнения запроса к БД: ".mysql_error()."<br>";
}
?>

<br><br>Редактирование должности:<br>
ID: <select name="combo_id">
<?php
$tmp = mysql_query("SELECT id_title FROM titles ORDER BY id_title ASC");
while (($mass_string = mysql_fetch_assoc($tmp)) != false)
{
    echo "<option value = \"".$mass_string["id_title"]."\">".$mass_string["id_title"]."</option>";  
}
echo "</select>
<input type=\"text\" name=\"edit_value\" placeholder=\"Новое название должности\" size=\"40\">
<input type=\"submit\" name=\"edit\" value=\"Редактировать\">";

if (isset($_GET["edit"]))
{
   $result = mysql_query("UPDATE titles SET name_title = '".$_GET["edit_value"]."' WHERE id_title = '".$_GET["combo_id"]."' LIMIT 1");

    if ($result)
    {
        unset ($_GET);
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=titles.php\">";
    }
    else echo "<br>Ошибка выполнения запроса к БД: ".mysql_error()."<br>";
}
?>

<br><br>Удаление должности:<br>
ID: <select name="combo_id2">
<?php
$tmp = mysql_query("SELECT id_title FROM titles ORDER BY id_title ASC");
while (($mass_string = mysql_fetch_assoc($tmp)) != false)
{
    echo "<option value = \"".$mass_string["id_title"]."\">".$mass_string["id_title"]."</option>";  
}
?>
</select>
<input type="submit" name="del" value="Удалить">

<?php
if (isset($_GET["del"]))
{
    $tmp = mysql_query("DELETE FROM titles WHERE id_title = '".$_GET["combo_id2"]."' LIMIT 1");
    if ($tmp) echo "<meta http-equiv=\"refresh\" content=\"0;URL=titles.php\">";
    else echo "<br>Ошибка выполнения запроса ".mysql_error()."<br>";
}
?>
</form>
</body>
</html>