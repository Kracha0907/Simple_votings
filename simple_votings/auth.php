
<?php 

require_once 'connect.php';
 

if (isset($_POST['doGo'])) {
    $error = "";
    if (!$_POST['login']) {
        $error = 'Введите логин';
    }
    if (!$_POST['pass']) {
        $error = 'Введите пароль';
    }
 
    if (!$error) {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
 
        if ($result = mysqli_query($db, "SELECT `password`, `id` FROM `users` WHERE `login`='" . $login . "'")) {
            while( $row = mysqli_fetch_assoc($result) ){ 
                if ($row['id'] >= 0) {
                    if ($pass == $row['password']) {
                        echo "Вы вошли";
                        include "menu.php";
                        exit;
                    } else {
                         echo "Пароль не совпадает";
                    }
                } else {
                    echo "Вы ввели неверный логин";
                }
            } 
        }
    } else {
        echo $error;
    }
}
    include "authform.php";

?>