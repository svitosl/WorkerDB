<!DOCTYPE HTML>
<meta charset="UTF-8">
<html>
<head>
	<title>Добавление рабочего</title>
</head>

<body>
<form action="" method="GET">
<h4>Информация о рабочем:</h4>
Фамилия:<br><input type="text" name="F" size="30"><br>
Имя:<br><input type="text" name="I" size="30"><br>
Отчество:<br><input type="text" name="O" size="30"><br>
Должность:<br><select name="combo_titles"><br>
<?php
	require_once("connect.php");
	$tmp = mysql_query("SELECT * FROM titles");
	while (($mass_string = mysql_fetch_assoc($tmp)) != false)
	{
		echo "<option value = \"".$mass_string["id_title"]."\">".$mass_string["name_title"]."</option>";
	}
?>
</select><br>
Цех:<br><select name="combo_workshop"><br>
<?php
	$tmp = mysql_query("SELECT * FROM workshop");
	while (($mass_string = mysql_fetch_assoc($tmp)) != false)
	{
		echo "<option value = \"".$mass_string["id_wrksh"]."\">".$mass_string["name_wrksh"]."</option>";
	}
?>
</select><br>
Разряд:<br><select name="combo_discharges"><br>
<?php
	$tmp = mysql_query("SELECT * FROM discharges");
	while (($mass_string = mysql_fetch_assoc($tmp)) != false)
	{
		echo "<option value = \"".$mass_string["id_disch"]."\">".$mass_string["coff_disch"]."</option>";
	}
?>
</select><br>
Дата поступления на работу:<br><input type="date" name="date_wrk"><br>
Размер з/п (руб.):<br><input type="number" name="salary" size="7"><br>
Стаж (лет):<br><input type="number" name="exp" size="3"><br>

<br>
<input type="submit" name="add" value="Добавить рабочего"><br><br>
</form>

<?php
if (isset($_GET["add"]))
{
	$result = mysql_query("INSERT INTO salary_worker (id_wrksh, id_title, id_disch, surname, name, midname, s_work, salary, exp)
						 VALUES ('".$_GET["combo_workshop"]."', '".$_GET["combo_titles"]."', '".$_GET["combo_discharges"]."', 
						 '".$_GET["F"]."', '".$_GET["I"]."', '".$_GET["O"]."', '".$_GET["date_wrk"]."', '".$_GET["salary"]."', 
						 '".$_GET["exp"]."')");

	if ($result) echo "Рабочий добавлен в БД";
	else echo "Ошибка выполнения запроса ".mysql_error();
}
?>

<br><br><form action="index.php"><input type="submit" value="<<< Вернуться назад"></form>
</body>
</html>
