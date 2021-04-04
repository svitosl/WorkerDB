<!DOCTYPE HTML>
<meta charset="UTF-8">
<html>
<head>
	<title>Редактирование рабочего</title>
</head>

<body>
<?php
require_once("connect.php");
$tmp = mysql_query("SELECT * FROM salary_worker WHERE id_wrk = '".$_GET["combo_id"]."'");
$person = mysql_fetch_assoc($tmp);
echo "<form action=\"\" method=\"GET\">
<div hidden><input type=\"text\" name=\"ID\" value=\"".$_GET["combo_id"]."\"></div>
<h4>Информация о рабочем:</h4>
Фамилия:<br><input type=\"text\" name=\"F\" value=\"".$person["surname"]."\" size=\"30\"><br>
Имя:<br><input type=\"text\" name=\"I\" value=\"".$person["name"]."\" size=\"30\"><br>
Отчество:<br><input type=\"text\" name=\"O\" value=\"".$person["midname"]."\" size=\"30\"><br>
Должность:<br><select name=\"combo_titles\"><br>";

	$tmp = mysql_query("SELECT * FROM titles");
	while (($mass_string = mysql_fetch_assoc($tmp)) != false)
	{
		if ($person["id_title"] == $mass_string["id_title"])
        {
        	echo "<option value = \"".$mass_string["id_title"]."\" selected>".$mass_string["name_title"]."</option>"; 
        }
        else echo "<option value = \"".$mass_string["id_title"]."\">".$mass_string["name_title"]."</option>"; 

	}

echo "</select><br>
Цех:<br><select name=\"combo_workshop\"><br>";

	$tmp = mysql_query("SELECT * FROM workshop");
	while (($mass_string = mysql_fetch_assoc($tmp)) != false)
	{
		if ($person["id_wrksh"] == $mass_string["id_wrksh"])
        {
        	echo "<option value = \"".$mass_string["id_wrksh"]."\" selected>".$mass_string["name_wrksh"]."</option>";
        }
        else echo "<option value = \"".$mass_string["id_wrksh"]."\">".$mass_string["name_wrksh"]."</option>"; 
	}

echo "</select><br>
Разряд:<br><select name=\"combo_discharges\"><br>";

	$tmp = mysql_query("SELECT * FROM discharges");
	while (($mass_string = mysql_fetch_assoc($tmp)) != false)
	{
		if ($person["id_disch"] == $mass_string["id_disch"])
        {
        	echo "<option value = \"".$mass_string["id_disch"]."\" selected>".$mass_string["coff_disch"]."</option>";
        }
        else echo "<option value = \"".$mass_string["id_disch"]."\">".$mass_string["coff_disch"]."</option>";
	}

echo "</select><br>
Дата поступления на работу:<br><input type=\"date\" name=\"date_wrk\" value=\"".$person["s_work"]."\"><br>
Размер з/п (руб.):<br><input type=\"number\" name=\"salary\" value=\"".$person["salary"]."\" size=\"7\"><br>
Стаж (лет):<br><input type=\"number\" name=\"exp\" value=\"".$person["exp"]."\" size=\"3\"><br>";
?>
<br>
<input type="submit" name="save" value="Сохранить"><br><br>
</form>

<?php
if (isset($_GET["save"]))
{
	$result = mysql_query("UPDATE salary_worker
						 SET id_wrksh = '".$_GET["combo_workshop"]."', id_title = '".$_GET["combo_titles"]."',
						 id_disch = '".$_GET["combo_discharges"]."', surname = '".$_GET["F"]."', name = '".$_GET["I"]."', 
						 midname = '".$_GET["O"]."', s_work = '".$_GET["date_wrk"]."', salary = '".$_GET["salary"]."',
						 exp = '".$_GET["exp"]."' WHERE id_wrk = '".$_GET["ID"]."' LIMIT 1");

	if ($result) echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
	else echo "Ошибка выполнения запроса ".mysql_error();
}
?>

<br><br><form action="index.php"><input type="submit" value="<<< Вернуться назад"></form>
</body>
</html>
