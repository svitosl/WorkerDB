<!DOCTYPE HTML>
<meta charset="UTF-8">
<html>
<head>
	<title>Работа по БД</title>
</head>

<body>
<br><font size="5">Выбор таблицы:</font><br>
<br>< <u>Зарплата рабочего</u> | <a href="workshop.php">Цехи</a> | <a href="titles.php">Должности</a> | <a href="discharges.php">Разряды</a> ><br>
<br>< <a href="list1.php">Список рабочих, сгруппированных по цехам</a> | <a href="list2.php">Cписок рабочих, имеющих одну и ту же должность</a> ><br>

<?php
require_once("connect.php");

$sql = "SELECT 
		salary_worker.id_wrk, salary_worker.surname, salary_worker.name,
		salary_worker.midname, salary_worker.s_work, salary_worker.salary, 
		salary_worker.exp, titles.name_title, workshop.name_wrksh, 
		discharges.coff_disch 
		FROM 
		salary_worker
		INNER JOIN titles
		ON salary_worker.id_title = titles.id_title
		INNER JOIN workshop
		ON salary_worker.id_wrksh = workshop.id_wrksh
		INNER JOIN discharges
		ON salary_worker.id_disch = discharges.id_disch ";

if (count($_GET) == 0 || isset($_GET["sort_id_1"])) $sql .= "ORDER BY salary_worker.id_wrk ASC";
else if (isset($_GET["sort_id_2"])) $sql .= "ORDER BY salary_worker.id_wrk DESC";
else if (isset($_GET["sort_title_1"])) $sql .= "ORDER BY titles.name_title ASC";
else if (isset($_GET["sort_title_2"])) $sql .= "ORDER BY titles.name_title DESC";
else if (isset($_GET["sort_exp_1"])) $sql .= "ORDER BY salary_worker.exp ASC";
else if (isset($_GET["sort_exp_2"])) $sql .= "ORDER BY salary_worker.exp DESC";
else $sql .= "ORDER BY salary_worker.id_wrk ASC";

$tmp = mysql_query($sql);

if ($tmp)
{
	if (mysql_num_rows($tmp) != false)
	{
		echo "<br>
			  <table border=\"1\" align=\"left\" cellpadding=\"0\">
	  		  <tr>
      		  <td align=\"center\">ID</td>
      		  <td align=\"center\">Фамилия</td>
      		  <td align=\"center\">Имя</td>
      		  <td align=\"center\">Отчество</td>
      		  <td align=\"center\">Должность</td>
      		  <td align=\"center\">Цех</td>
      		  <td align=\"center\">Разряд</td>
      		  <td align=\"center\">Дата пост. на раб.</td>
      		  <td align=\"center\">Размер з/п (руб.)</td>
      		  <td align=\"center\">Стаж (лет)</td>
      		  </tr>";

		while (($mass_data = mysql_fetch_assoc($tmp)) != false)
		{
			$str = "<tr>";
			$str .= "<td align=\"center\">".$mass_data["id_wrk"]."</td>";
			$str .= "<td align=\"center\">".$mass_data["surname"]."</td>";
			$str .= "<td align=\"center\">".$mass_data["name"]."</td>";
			$str .= "<td align=\"center\">".$mass_data["midname"]."</td>";
			$str .= "<td align=\"center\">".$mass_data["name_title"]."</td>";
			$str .= "<td align=\"center\">".$mass_data["name_wrksh"]."</td>";
			$str .= "<td align=\"center\">".$mass_data["coff_disch"]."</td>";
			$str .= "<td align=\"center\">".$mass_data["s_work"]."</td>";
			$str .= "<td align=\"center\">".$mass_data["salary"]." руб.</td>";
			$str .= "<td align=\"center\">".$mass_data["exp"]."</td>";
			$str .= "</tr>";
			echo "$str";
		}
		echo "</table>";
	}
	else echo "<br>Список рабочих пуст<br>";
}
else echo "<br>Ошибка выполнения запроса ".mysql_error()."<br>";

for ($i=0; $i<mysql_num_rows($tmp); $i++) echo "<br><br>";
?>

<form action="" method="GET">
<input type="submit" name="sort_id_1" value="Сортировать по умолчанию (ID: 1-10)">
<input type="submit" name="sort_id_2" value="Сортировать по умолчанию (ID: 10-1)"><br>
<input type="submit" name="sort_title_1" value="Сортировать по должности (А-Я)">
<input type="submit" name="sort_title_2" value="Сортировать по должности (Я-А)"><br>
<input type="submit" name="sort_exp_1" value="Сортировать по стажу (1-10)">
<input type="submit" name="sort_exp_2" value="Сортировать по стажу (10-1)">
</form>

<br>
<form action="add_wrk.php"><input type="submit" value="Добавить рабочего">
</form>

<br>Редактирование рабочего: <br>
<form action="edit_wrk.php" method="GET">ID: <select name="combo_id">
<?php
$tmp = mysql_query("SELECT id_wrk FROM salary_worker ORDER BY id_wrk ASC");
while (($mass_string = mysql_fetch_assoc($tmp)) != false)
{
    echo "<option value = \"".$mass_string["id_wrk"]."\">".$mass_string["id_wrk"]."</option>";  
}
?>
</select>
<input type="submit" name="edit" value="Редактировать">
</form>

<br>Удаление рабочего: <br>
<form action="" method="GET">ID: <select name="combo_id2">
<?php
$tmp = mysql_query("SELECT id_wrk FROM salary_worker ORDER BY id_wrk ASC");
while (($mass_string = mysql_fetch_assoc($tmp)) != false)
{
    echo "<option value = \"".$mass_string["id_wrk"]."\">".$mass_string["id_wrk"]."</option>";  
}
?>
</select>
<input type="submit" name="del" value="Удалить">

<br><br>Максимальная зар. плата:<br>
<?php
if (isset($_GET["btn_salary"]))
{
	$tmp = mysql_query("SELECT MAX(salary) FROM salary_worker");
	if ($tmp)
	{
		$mass_string = mysql_fetch_assoc($tmp);
		echo "<input type=\"text\" name=\"val_sal\" value=\"".$mass_string["MAX(salary)"]."\" size=\"10\">";
	}
	else echo "<br>Ошибка выполнения запроса ".mysql_error()."<br>";
}
else
{
	echo "<input type=\"text\" name=\"val_sal\" placeholder=\"Макс. зарплата\" size=\"12\">";
}
?>
<input type="submit" name="btn_salary" value="Рассчитать">

<?php
if (isset($_GET["btn_search"]))
{
	if ($_GET["search"] == "title")
	echo "<br><br>Поиск <input name=\"search\" type=\"radio\" value=\"title\" checked>по должности <input name=\"search\" type=\"radio\" value=\"surname\">по фамилии";

	if ($_GET["search"] == "surname")
	echo "<br><br>Поиск <input name=\"search\" type=\"radio\" value=\"title\">по должности <input name=\"search\" type=\"radio\" value=\"surname\" checked>по фамилии";

	echo "<br><input type=\"text\" name=\"txt_search\" value=\"".$_GET["txt_search"]."\" size=\"35\">";

}
else
{
	echo "<br><br>Поиск <input name=\"search\" type=\"radio\" value=\"title\" checked>по должности <input name=\"search\" type=\"radio\" value=\"surname\">по фамилии
	<br><input type=\"text\" name=\"txt_search\" placeholder=\"Введите значение/часть значения\" size=\"35\">";
}
?>
<input type="submit" name="btn_search" value="Найти">

<br><br>Поиск по дате поступления на работу
<?php
if (isset($_GET["btn_date_search"])) echo "<br><input type=\"date\" name=\"date_search\" value=\"".$_GET["date_search"]."\">";
else echo "<br><input type=\"date\" name=\"date_search\">";
?>
<input type="submit" name="btn_date_search" value="Найти">
</form>

<?php
if (isset($_GET["del"]))
{
	$tmp = mysql_query("DELETE FROM salary_worker WHERE id_wrk = '".$_GET["combo_id2"]."' LIMIT 1");
	if ($tmp) echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
	else echo "Ошибка выполнения запроса ".mysql_error();
}

if (isset($_GET["btn_search"]))
{
	$sql = "SELECT salary_worker.id_wrk, salary_worker.surname, salary_worker.name, salary_worker.midname";
	if ($_GET["search"] == "title") $sql .= ", titles.name_title";
	$sql .= " FROM salary_worker";
	if ($_GET["search"] == "title") $sql .= " INNER JOIN titles ON salary_worker.id_title = titles.id_title";
	if ($_GET["search"] == "title") $sql .= " WHERE titles.name_title";
	if ($_GET["search"] == "surname") $sql .= " WHERE salary_worker.surname";
	$sql .= " like '%".$_GET["txt_search"]."%'";
	$tmp = mysql_query($sql);

	if ($tmp)
	{	
		echo "<br>Результаты поиска:<br>";
		if (mysql_num_rows($tmp) == false || $_GET["txt_search"] == "") echo "Значение не найдено";
		else
		{
			echo "<br><table align=\"left\" border=\"1\" cellpadding=\"0\">
			<tr>
    		<td align=\"center\">ID</td>
    		<td align=\"center\">Фамилия</td>
    		<td align=\"center\">Имя</td>
    		<td align=\"center\">Отчество</td>";
			if ($_GET["search"] == "title") echo "<td align=\"center\">Должность</td>";
			echo "</tr>";
			while (($mass_string = mysql_fetch_assoc($tmp)) != false)
			{
				$str = "<tr>";
				$str .= "<td align=\"center\">".$mass_string["id_wrk"]."</td>";
		 		$str .= "<td align=\"center\">".$mass_string["surname"]."</td>";
		 		$str .= "<td align=\"center\">".$mass_string["name"]."</td>";
		 		$str .= "<td align=\"center\">".$mass_string["midname"]."</td>";
		 		if ($_GET["search"] == "title") $str .= "<td align=\"center\">".$mass_string["name_title"]."</td>";
		 		$str .= "</tr>";
		 		echo "$str";
			}
			echo "</table>";
		}
	}
	else echo "Ошибка выполнения запроса ".mysql_error();
}
if (isset($_GET["btn_date_search"]))
{
	$tmp = mysql_query("SELECT id_wrk, surname, name, midname, s_work 
					    FROM salary_worker 
						WHERE s_work = \"".$_GET["date_search"]."\"");
	if ($tmp)
	{	
		echo "<br>Результаты поиска:<br>";
		if (mysql_num_rows($tmp) == false) echo "Значение не найдено";
		else
		{
			echo "<br><table align=\"left\" border=\"1\" cellpadding=\"0\">
			<tr>
    		<td align=\"center\">ID</td>
    		<td align=\"center\">Фамилия</td>
    		<td align=\"center\">Имя</td>
    		<td align=\"center\">Отчество</td>
			<td align=\"center\">Дата пост. на раб.</td>
			</tr>";

			while (($mass_string = mysql_fetch_assoc($tmp)) != false)
			{
				$str = "<tr>";
				$str .= "<td align=\"center\">".$mass_string["id_wrk"]."</td>";
		 		$str .= "<td align=\"center\">".$mass_string["surname"]."</td>";
		 		$str .= "<td align=\"center\">".$mass_string["name"]."</td>";
		 		$str .= "<td align=\"center\">".$mass_string["midname"]."</td>";
		 		$str .= "<td align=\"center\">".$mass_string["s_work"]."</td>";
		 		$str .= "</tr>";
		 		echo "$str";
			}
			echo "</table>";
		}
	}
	else echo "Ошибка выполнения запроса ".mysql_error();
}
?>
</body>
</html>
