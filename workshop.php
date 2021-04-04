<!DOCTYPE HTML>
<meta charset="UTF-8">
<html>
<head>
	<title>Работа по БД</title>
</head>

<body>
<br><font size="5">Выбор таблицы:</font><br>
<br>< <a href="index.php">Зарплата рабочего</a> | <u>Цехи</u> | <a href="titles.php">Должности</a> | <a href="discharges.php">Разряды</a> ><br>
<br>
<table border="1" align="left" cellpadding="0">
<tr>
    <td align="center">ID</td>
    <td align="center">Название цеха</td>
 </tr>

<?php
require_once("connect.php");
$data = mysql_query("SELECT * FROM `workshop`");

while (($mass_data = mysql_fetch_assoc($data)) != false)
{
    $str = "<tr>";
    $str .= "<td align=\"center\">".$mass_data["id_wrksh"]."</td>";
    $str .= "<td align=\"center\">".$mass_data["name_wrksh"]."</td>";
    $str .= "</tr>";
    echo "$str";
}
echo "</table>";
for ($i=0; $i<mysql_num_rows($data); $i++) echo "<br><br>";
?>

Добавление цеха: <form action="" method="GET"><input type="text" name="workshop" placeholder="Название цеха" size="50">
<input type="submit" name="add" value="Добавить цех">
    
<?php
if (isset($_GET["add"]))
{
    $result = mysql_query("INSERT INTO workshop (name_wrksh) VALUES ('".$_GET["workshop"]."')");

    if ($result)
    {
        unset ($_GET);
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=workshop.php\">";
    }
    else echo "<br>Ошибка выполнения запроса к БД: ".mysql_error()."<br>";
}
?>

<br><br>Редактирование цеха:<br>
ID: <select name="combo_id">
<?php
$tmp = mysql_query("SELECT id_wrksh FROM workshop ORDER BY id_wrksh ASC");
while (($mass_string = mysql_fetch_assoc($tmp)) != false)
{
    echo "<option value = \"".$mass_string["id_wrksh"]."\">".$mass_string["id_wrksh"]."</option>";  
}
echo "</select>
<input type=\"text\" name=\"edit_value\" placeholder=\"Новое название цеха\" size=\"40\">
<input type=\"submit\" name=\"edit\" value=\"Редактировать\">";

if (isset($_GET["edit"]))
{
   $result = mysql_query("UPDATE workshop SET name_wrksh = '".$_GET["edit_value"]."' WHERE id_wrksh = '".$_GET["combo_id"]."' LIMIT 1");

    if ($result)
    {
        unset ($_GET);
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=workshop.php\">";
    }
    else echo "<br>Ошибка выполнения запроса к БД: ".mysql_error()."<br>";
}
?>

<br><br>Удаление цеха:<br>
ID: <select name="combo_id2">
<?php
$tmp = mysql_query("SELECT id_wrksh FROM workshop ORDER BY id_wrksh ASC");
while (($mass_string = mysql_fetch_assoc($tmp)) != false)
{
    echo "<option value = \"".$mass_string["id_wrksh"]."\">".$mass_string["id_wrksh"]."</option>";  
}
?>
</select>
<input type="submit" name="del" value="Удалить">

<?php
if (isset($_GET["del"]))
{
    $tmp = mysql_query("DELETE FROM workshop WHERE id_wrksh = '".$_GET["combo_id2"]."' LIMIT 1");
    if ($tmp) echo "<meta http-equiv=\"refresh\" content=\"0;URL=workshop.php\">";
    else echo "<br>Ошибка выполнения запроса ".mysql_error()."<br>";
}
?>

<br><br>Сумма заработной платы в 1 цеху (тыс. руб.):<br>
<select name="combo_workshop">
<?php
    $tmp = mysql_query("SELECT * FROM workshop");
    while (($mass_string = mysql_fetch_assoc($tmp)) != false)
    {
        if ($mass_string["id_wrksh"] == $_GET["combo_workshop"])
        {
            echo "<option value = \"".$mass_string["id_wrksh"]."\" selected>".$mass_string["name_wrksh"]."</option>";  
        }
        else echo "<option value = \"".$mass_string["id_wrksh"]."\">".$mass_string["name_wrksh"]."</option>";
    }
echo "</select>";

if (isset($_GET["sum"]))
{
   $result = mysql_query("SELECT SUM(salary) FROM salary_worker WHERE id_wrksh = '".$_GET["combo_workshop"]."'");
   $res_str = mysql_fetch_assoc($result);
   if ($res_str["SUM(salary)"] == NULL)  echo "<input name=\"textfield\" type=\"text\" value=\"0\">";
   else echo "<input name=\"textfield\" type=\"text\" value=\"".$res_str["SUM(salary)"]."\">";
}
else echo "<input name=\"textfield\" type=\"text\" placeholder=\"ещё не рассчитано\">";
?>
<input type="submit" name="sum" value="Посчитать">
</form>
</body>
</html>