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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="styles/style.css" rel="stylesheet" type="text/css">
</head>
<body>
  <br>
  <br>
        <div class="col">
           <h1>Форма регистрации</h1>
           <form  action="check-in.php" method="post">
             <input type="text" class="form-control" name="login" id="" placeholder="Введите ваш логин"><br>
             <input type="email" class="form-control" name="email" id="" placeholder="Введите ваш email"><br>
             <input type="password" class="form-control" name="pass" id="" placeholder="Введите ваш пароль"><br>
             <input type="password" class="form-control" name="pass_rep" id="" placeholder="Повторите пароль"><br>
             <?php $year = date('Y'); ?>
        Год рождения:
        <select name="year_of_birth" id="">
        <option value="">----</option>
            <?php for ($i = $year - 14; $i > $year - 14 - 100; $i--) { ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php } ?>
        </select>
             <br><input button class="btn btn-success" type="submit" value="Зарегистрироваться" name="doGo"><br>
           </form>
</body>
</html>