<?php
require_once 'connect.php';
include "menu.php";
	$id_test = $_GET["val"] + 1;
	if ($result = mysqli_query($db, "SELECT name FROM test WHERE id = $id_test")) {
		$test_name = mysqli_fetch_assoc($result)["name"];
	}
	$variants = array();
	if ($result = mysqli_query($db, "SELECT text, id FROM question WHERE id_test = $id_test")) {
		$questions = array();
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($questions, $row["text"]);
			$id_question = $row["id"];
			$tmp = array();
			if ($result1 = mysqli_query($db, "SELECT text FROM variant WHERE id_question = $id_question")) {
				while ($row1 = mysqli_fetch_assoc($result1)) {
					array_push($tmp, $row1["text"]);
				}
			}
			array_push($variants, $tmp);
		}
	}

echo '
	<!DOCTYPE html>
	<head>
	<title>Голосование с выводом в новом окне</title>
	</head>
	<body>
	<h1 align="center">',$test_name,'</h1>
	
	<form name=form action="answers.php" method=POST>';
	for ($i = 0; $i < count($questions); $i++)
	{
		echo '<input type="hidden" name="questions[]" value="', $questions[$i], '" />';
	}
	echo '<input type="hidden" name="id_test" value="', $id_test, '" />';

for ($i = 0; $i < count($questions); $i++)
{
	echo '
	<h3>',$i + 1,')',$questions[$i],'</h3>';
	for ($j = 0; $j < count($variants[$i]); $j++)                                              
	{
		echo '<p>', $variants[$i][$j] . "	", '<input type=radio name=',$i,' value="',$variants[$i][$j],'"></p>';
	}
	echo '<hr>';
}
echo '
	<input button class="btn btn-primary" type="submit" value="Завершить">
	</form>

	</body>
	</html>';