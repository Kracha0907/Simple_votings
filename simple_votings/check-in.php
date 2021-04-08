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
 
    if (!$error) {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $DOB = $_POST['year_of_birth'];
        
        if (mysqli_query($db, "INSERT INTO `users` (`login`, `email`, `password`, `DOB`) VALUES 
        ('" . $login . "','" . $email . "','" . $pass . "', '" . $DOB . "')"))
            echo 'Регистрация прошла успешна';
    } else {
        echo $error; 
    }
}
    include "check-in_form.php";
?>
