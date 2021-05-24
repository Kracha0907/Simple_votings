<?php
  include "menu.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма регистрации</title>
</head>
<body>
  <br>
  <br>
        <div class="col">
           <h1>Форма регистрации</h1>
            <form  action="check-in.php" method="post">
             <input type="text" class="form-control" name="nam" id="1" placeholder="Введите ваше имя"><br>
             <input type="text" class="form-control" name="surname" id="1" placeholder="Введите вашу фамилию"><br>
             <input type="text" class="form-control" name="login" id="1" placeholder="Введите ваш логин"><br>
             <input type="email" class="form-control" name="email" id="2" placeholder="Введите ваш email"><br>
             <input type="password" class="form-control" name="pass" id="3" placeholder="Введите ваш пароль"><br>
             <input type="password" class="form-control" name="pass_rep" id="4" placeholder="Повторите пароль"><br>
             <br><input button class="btn btn-success" type="submit" value="Зарегистрироваться" name="doGo"><br>
           </form>
</body>
</html>
