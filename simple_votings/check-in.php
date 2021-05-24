<?php 
require_once 'connect.php';
 
    
if (isset($_POST['doGo'])) {
    $error = "";
    if ($_POST['pass'] !== $_POST['pass_rep']) {
        $error = 'Пароль не совпадает';
    }
    
    if (!$_POST['pass_rep']) {
        $error = 'Введите повторный пароль';
    }
    
    if (!$_POST['pass']) {
        $error = 'Введите пароль';
    }
 
    if (!$_POST['email']) {
        $error = 'Введите email';
    }
 
    if (!$_POST['login']) {
        $error = 'Введите login';
    }

    if (!$_POST['nam']) {
        $error = 'Введите имя';
    }

    if (!$_POST['surname']) {
        $error = 'Введите фамилию';
    }
 
    if (!$error) {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $name = $_POST["nam"];
        $surname = $_POST["surname"];
        date_default_timezone_set('Europe/Moscow');
        $data_joined = date("Y-m-d H:i:s");
        
        if (mysqli_query($db, "INSERT INTO `users` (`name`, `surname`, `login`, `email`, `password`, `data_joined`) VALUES 
        ('" . $name . "','" . $surname . "','" . $login . "','" . $email . "','" . $pass . "','" . $data_joined . "')"))
        {
            setcookie("current_user", $login);
            header('Location: http://localhost/simple_votings/index.php');
        }
    } else {
        echo $error; 
    }
}
?>
