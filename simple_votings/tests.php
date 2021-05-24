<head>
    <style type="text/css">
        .hide,
        .hide + label ~ div {
            display: none;
        }
        /* вид текста label */
        .hide + label {
            margin: 0;
            padding: 0;
            color: green;
            cursor: pointer;
            display: inline-block;
        }
        /* развернутый вид */
        .hide:checked + label {
            color: red;
            border-bottom: 0;
        }
        /* показ блоков с содержанием  */
        .hide:checked + label + div {
            display: block;
            /* анимация при появлении */
            -webkit-animation:fade ease-in 0.5s;
            -moz-animation:fade ease-in 0.5s;
            animation:fade ease-in 0.5s;
        }
        /* анимация при появлении скрытых блоков */
        @-moz-keyframes fade {
            from { opacity: 0; }
        to { opacity: 1 }
        }
        @-webkit-keyframes fade {
            from { opacity: 0; }
        to { opacity: 1 }
        }
        @keyframes fade {
            from { opacity: 0; }
        to { opacity: 1 }
        }
        .hide + label:before {
            background-color: #1e90ff;
            color: #fff;
            content: "\002B";
            display: block;
            float: left;
            font-size: 14px;
            font-weight: bold;
            height: 16px;
            line-height: 16px;
            margin: 3px 5px;
            text-align: center;
            width: 16px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }
        .hide:checked + label:before {
            content: "\2212";
        }
    </style>
</head>

<?php
include "menu.php";
require_once 'connect.php';
$current_login = $_COOKIE["current_user"];
if ($current_login == "anonymus")
      echo '<h2>Автоизируйтесь для участия в тестах!</h2>';
echo '
    <form action="search.php" method="post">
    <div class="btn-group">
        <input button class="btn btn-primary" type="submit" value="Найти">
        <input type="text" class="form-control" name="search"><br>
    </div>
    </form>
    <div>
        <br><a href="/simple_votings/tests.php?val=sort" class="btn btn-primary"> Сортировать по названию </a>
        <a href="/simple_votings/tests.php?val=none" class="btn btn-primary"> По умолчанию </a><br>
    </div>
    <br>';

if (array_key_exists('val', $_GET))
{
    $type = $_GET["val"];
}
else
{
    $type = "none";
}
if ($result = mysqli_query($db, "SELECT name FROM test")) {
    $tests = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($tests, $row["name"]);
    }
    if ($type == "sort")
    {
        sort($tests);
    }
    elseif ($type != "none")
    {
        $tmp = array();
        for ($i = 0; $i < count($tests); $i++)
        {
            if (mysqli_fetch_assoc(mysqli_query($db, "SELECT `theme` FROM `test` WHERE `name` ='" . $tests[$i] . "'"))["theme"] == $type)
            {
                array_push($tmp, $tests[$i]);
            }
        }
        $tests = array();
        for ($i = 0; $i < count($tmp); $i++)
        {
            array_push($tests, $tmp[$i]);
        }
    }

    for ($i = 0; $i < count($tests); $i++)
    {
        $name = $tests[$i];
        echo '
            <div class="col-md6 border rounded">
            <div class="demo">
                <input type="checkbox" id="',$i,'" class="hide"/>
                <label for="',$i,'" >',$tests[$i],'</label>
                <div>
                    <h3>Тема: ',mysqli_fetch_assoc(mysqli_query($db, "SELECT `theme` FROM `test` WHERE `name` ='" . $tests[$i] . "'"))["theme"],'</h3>
                    <h3>Описание: <h3><h6>',mysqli_fetch_assoc(mysqli_query($db, "SELECT `description` FROM `test` WHERE `name` ='" . $tests[$i] . "'"))["description"],'</h6>';
                    if ($current_login != "anonymus")
                    {
                        echo '
                            <a href="/simple_votings/test.php?val=',$i,'" class="btn btn-success">
                            Пройти
                            </a>';
                        if (mysqli_fetch_assoc(mysqli_query($db, "SELECT `is_admin` FROM `users` WHERE `login`='" . $_COOKIE["current_user"] . "'"))["is_admin"] == 1)
                        {
                            echo '
                            <a href="/simple_votings/delete_test.php?val=',$i,'" class="btn btn-danger">
                            Удалить
                            </a>';
                        }
                    }
        echo '
                </div>
            </div>
            </div>';
    }
}
?>