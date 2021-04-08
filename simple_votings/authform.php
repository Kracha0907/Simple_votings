<?php
  include "menu.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма авторизации</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="styles/style.css" rel="stylesheet" type="text/css">
</head>
<body>
  <br>
  <br>
        <div class="col">
           <h1>Форма авторизации</h1>
           <form  action="auth.php" method="post">
             <input type="text" class="form-control" name="login"id="" placeholder="Введите ваш логин"><br>

             <input type="password" class="form-control" name="pass" id="" placeholder="Введите ваш пароль"><br>

             <br><input button class="btn btn-success" type="submit" value="Авторизироваться" name="doGo"><br>
           </form>
</body>
</html>