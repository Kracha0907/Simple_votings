    <?php
    require_once 'connect.php';
    include "menu.php";
    $res = 0;
    $questions = $_POST['questions'];
    for ($i = 0; $i < count($questions); $i++)
	{
        $result = mysqli_query($db, "SELECT `answer` FROM `question` WHERE `text` =  '" . $questions[$i] . "'");
        $answer = mysqli_fetch_assoc($result)["answer"];
        echo '<h2 style="color:#41E2F0">',$i + 1,') ',$questions[$i],'</h2>';
        if(isset($_POST[$i])) {
            echo "<div>
                <h3>Ваш ответ: </h3>";
            if ($_POST[$i] == $answer) {
                $res++;
                echo '<h3 style="color:#4AE526">',$_POST[$i],'</h3>';
            }
            else
            {
                echo '<h3 style="color:rgb(255,0,0)">',$_POST[$i],'</h3>';
            }
            echo '</div>';
        }
        else
        {
            echo '<h3 style="color:rgb(255,0,0)">Вы не ответили на этот вопрос</h3>';
        }
        echo '
            <div>
                <h3>Правильный ответ: </h3><h3 style="color:#2089E9">', $answer, '</h3><br/><hr>
            </div>';
	}
    echo "<h3>Всего правильных ответов ", $res," из ", count($questions),"</h3>";
    $res = (String) $res . "/" . (String) count($questions);
    $current_user = $_COOKIE["current_user"];
    $id_user = mysqli_fetch_assoc(mysqli_query($db, "SELECT `id` FROM `users` WHERE `login` = '" . $current_user . "'"))['id'];
    $id_test = $_POST["id_test"];
    if (!mysqli_query($db, "INSERT INTO `result` (`id_user`, `id_test`, `result`) VALUES 
        ('" . $id_user . "', '" . $id_test . "', '" . $res . "')"))
        echo "bad";
    ?>
    