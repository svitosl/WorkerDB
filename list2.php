<!DOCTYPE HTML>
<meta charset="UTF-8">
<html>
<head>
	<title>Работа по БД</title>
</head>

<body>
<br><form action="index.php"><input type="submit" value="<<< Вернуться назад"></form><br>

<font size="5">Выберите должность:</font><br><br>
<form action="" method="GET"><select name="combo_title">
<?php
require_once("connect.php");

$data = mysql_query("SELECT * FROM titles ORDER BY name_title ASC");
while (($mass_string = mysql_fetch_assoc($data)) != false)
{
	if ($mass_string["id_title"] == $_GET["combo_title"])
    {
    	echo "<option value = \"".$mass_string["id_title"]."\" selected>".$mass_string["name_title"]."</option>";
    }
    else echo "<option value = \"".$mass_string["id_title"]."\">".$mass_string["name_title"]."</option>";
}
?>
</select>
<input type="submit" name="check" value="Выбрать">
</form>
<?php
if (isset($_GET["check"]))
{
$data = mysql_query("SELECT 
				     salary_worker.surname, salary_worker.name, salary_worker.midname, salary_worker.exp, titles.name_title, workshop.name_wrksh, discharges.coff_disch 
				     FROM 
				     salary_worker
				     INNER JOIN titles
				     ON salary_worker.id_title = titles.id_title
				     INNER JOIN workshop
				     ON salary_worker.id_wrksh = workshop.id_wrksh
				     INNER JOIN discharges
				     ON salary_worker.id_disch = discharges.id_disch
				     WHERE salary_worker.id_title = '".$_GET["combo_title"]."'
				     ");

if ($data)
{
	if (mysql_num_rows($data) == false) echo "<br>Список рабочих (с данной должностью) пуст<br>";
	else
	{
		echo "<br><br><table align=\"left\" cellpadding=\"0\">
			  <tr>
	    	  <td align=\"left\">ФИО</td>
	    	  <td align=\"left\">Цех</td>
	    	  <td align=\"left\">Стаж (лет)</td>
	    	  <td align=\"left\">Разряд</td>
	    	  <td align=\"left\">Должность</td>
	 		  </tr>";

		while (($mass_string = mysql_fetch_assoc($data)) != false)
		{
		 	$str = "<tr>";
		 	$str .= "<td align=\"left\">".$mass_string["surname"]." ".$mass_string["name"]." ".$mass_string["midname"]."</td>";
		 	$str .= "<td align=\"left\">".$mass_string["name_wrksh"]."</td>";
		 	$str .= "<td align=\"left\">".$mass_string["exp"]."</td>";
		 	$str .= "<td align=\"left\">".$mass_string["coff_disch"]."</td>";
		 	$str .= "<td align=\"left\">".$mass_string["name_title"]."</td>";
		 	$str .= "</tr>";
		 	echo "$str";
		}
		echo "</table>";
	}
}
else echo "<br>Ошибка выполнения запроса ".mysql_error()."<br>";
}
?>
</body>
</html>