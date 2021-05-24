<?php
    require_once "connect.php";
    $id_test = $_GET["val"] + 1;
    mysqli_query($db, "DELETE FROM test WHERE id = " . $id_test);

    $result = mysqli_query($db, "SELECT text, id FROM question WHERE id_test = $id_test");
	$questions = array();
	while ($row = mysqli_fetch_assoc($result)) {
		array_push($questions, $row["id"]);
    }
    for ($i = 0; $i < count($questions); $i++)
    {
        mysqli_query($db, "DELETE FROM variant WHERE id_question = " . $questions[$i]);
        mysqli_query($db, "DELETE FROM question WHERE id_test = " . $id_test);
    }

    mysqli_query($db, "DELETE FROM result WHERE id_test = " . $id_test);
    header('Location: http://localhost/simple_votings/tests.php');
?>