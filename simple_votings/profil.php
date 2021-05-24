<?php
include "menu.php";
require_once "connect.php";
if ($_COOKIE['current_user'] != "anonymus")
{
    $user = mysqli_fetch_assoc(mysqli_query($db, "SELECT `id`, `login`, `name`, `surname`, `email`, `data_joined` FROM `users` WHERE `login`='" . $_COOKIE['current_user'] . "'"));
    $id = $user["id"];
    $login = $user["login"];
    $name = $user["name"];
    $surname = $user["surname"];
    $email = $user["email"];
    $data_joined = $user["data_joined"];
    echo '
        <h4>История профиля</h4>
        <table class="table table-th-block">
        <tbody>
        <tr><td class="active">Зарегистрирован:</td><td>',$data_joined,'</td></tr>
        <tr><td class="active">Имя:</td><td>',$name,'</td></tr>
        <tr><td class="active">Фамилия:</td><td>',$surname,'</td></tr>
        <tr><td class="active">Логин:</td><td>',$login,'</td></tr>
        <tr><td class="active">Email:</td><td>',$email,'</td></tr>
        </tbody>
        </table>
        <h4>Участие в тестах</h4>
        <table class="table table-th-block">
        <tbody>
        <tr>
        <th>Название теста</th>
        <th>Результат</th>
        </tr>';
        $result = mysqli_query($db, "SELECT `id_test`, `result` FROM `result` WHERE `id_user`='" . $id . "'");
        $results = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $name = mysqli_fetch_assoc(mysqli_query($db, "SELECT `name` FROM `test` WHERE `id`=" . $row["id_test"] . ""))["name"];
            array_push($results, array($name, $row["result"]));
        }
        for ($i = 0; $i < count($results); $i++)
        {
            echo '<tr><td class="active">',$results[$i][0],'</td><td>',$results[$i][1],'</td></tr>';
        }
        echo '
        </tbody>
        </table>';
    }
    else
    {
        echo '<h1>Автоизируйтесь для просмотра профиля!</h1>';
    }