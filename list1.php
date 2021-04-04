<!DOCTYPE HTML>
<meta charset="UTF-8">
<html>
<head>
	<title>Работа по БД</title>
</head>

<body>
<br><form action="index.php"><input type="submit" value="<<< Вернуться назад"></form><br>
<?php
require_once("connect.php");
$data = mysql_query("SELECT 
				     salary_worker.surname, salary_worker.name, salary_worker.midname, salary_worker.salary, titles.name_title, workshop.name_wrksh 
				     FROM 
				     salary_worker
				     INNER JOIN titles
				     ON salary_worker.id_title = titles.id_title
				     INNER JOIN workshop
				     ON salary_worker.id_wrksh = workshop.id_wrksh
				     GROUP BY workshop.name_wrksh
				     ORDER BY salary_worker.salary ASC
				     ");

if ($data)
{
	if (mysql_num_rows($data) == false) echo "<br>Список рабочих пуст<br>";
	else
	{
		echo "<table align=\"left\" cellpadding=\"0\">
			  <tr>
    	 	 <td align=\"left\">ФИО</td>
    	 	 <td align=\"left\">Должность</td>
    	 	 <td align=\"left\">Размер з/п</td>
    	 	 <td align=\"left\">Цех</td>
 		 	 </tr>";

			while (($mass_data = mysql_fetch_assoc($data)) != false)
			{
			 	$str = "<tr>";
			 	$str .= "<td align=\"left\">".$mass_data["surname"]." ".$mass_data["name"]." ".$mass_data["midname"]."</td>";
			 	$str .= "<td align=\"left\">".$mass_data["name_title"]."</td>";
			 	$str .= "<td align=\"left\">".$mass_data["salary"]."</td>";
			 	$str .= "<td align=\"left\">".$mass_data["name_wrksh"]."</td>";
			 	$str .= "</tr>";
			 	echo "$str";
			}
			echo "</table>";
	}
}
else echo "<br>Ошибка выполнения запроса ".mysql_error()."<br>";
?>
</body>
</html>