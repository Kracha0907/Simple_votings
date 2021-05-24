<?php
  include "menu.php";
  require_once 'connect.php';
  if ($_COOKIE['current_user'] != "anonymus")
  {
    $result = mysqli_query($db, "SELECT `is_banned` FROM `users` WHERE `login`='" . $_COOKIE['current_user'] . "'");
    if (mysqli_fetch_assoc($result)["is_banned"] == 1)
    {
      header('Location: http://localhost/simple_votings/banned_user.php');
    }
  }
?>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Главная</title>
    <style type="text/css">
    img {
      max-width: 100%;
      max-height: 100%;
    }

    h1 {
      font-size: 50px;
      margin-top: 30px;
      margin-bottom: 20px;
      text-align: center;
    }

    h2 {
      margin-top: 40px;
      margin-bottom: 20px;
    }

    p {
      font-size: 18px;
      text-align: justify;
    }
    </style>
  </head>
  <body>
  </form>
    <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Добро пожаловать на сайт с лучшими тестами!</h1>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <p>Здесь вы можете искать сайты на различные тематики и участвовать в них.</p>
      </div>
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <img src="https://1.downloader.disk.yandex.ru/preview/95d4507c65b91b991e2e9004fa43ea8b8450128d8e59f72e9cad11676ad622fe/inf/_nNWKBsowgsXurOHwEHvUG1hKyl63di85_z740OHlLg334j1GNIMDQkZJA6AXIGrFPIXZxJ6DfkN-kKKE_4xeA%3D%3D?uid=552066248&filename=1.jpg&disposition=inline&hash=&limit=0&content_type=image%2Fjpeg&owner_uid=552066248&tknv=v2&size=1898x872">
      </div>
    </div>
  </div>
  </body>
    <?php
    require_once 'connect.php';
    if(!isset($_COOKIE['current_user'])) {
      setcookie("current_user", "anonymus", strtotime("+30 days"));
    }
    if ($_COOKIE['current_user'] == "anonymus")
      echo '<h2>Вы не авторизированы!</h2>';
    else if (mysqli_fetch_assoc(mysqli_query($db, "SELECT `is_admin` FROM `users` WHERE `login`='" . $_COOKIE['current_user'] . "'"))["is_admin"] == 1)
    {
      echo '<h2 style="text-align: center">Здравствуйте, ', $_COOKIE['current_user'], '! Вы зашли под именем администратора</h2>';
      echo '<form action="ban.php" method="post">
              <div class="btn-group">
                  <input button class="btn btn-danger" type="submit" value="Заблокировать пользователя">
                  <input type="text" class="form-control" name="ban"><br>
              </div>
              </form><br>';
        echo '<form action="unban.php" method="post">
        <div class="btn-group">
            <input button class="btn btn-primary" type="submit" value="Разблокировать пользователя">
            <input type="text" class="form-control" name="unban"><br>
        </div>
        </form>';
    }
    else
    {
      $result = mysqli_query($db, "SELECT `is_banned` FROM `users` WHERE `login`='" . $_COOKIE['current_user'] . "'");
      if (mysqli_fetch_assoc($result)["is_banned"] == 1)
      {
        echo 1;
      }
      else
      {
        echo '<h2>Здравствуйте, ', $_COOKIE['current_user'], '!</h2>';
      }
    }

      if (array_key_exists('ban', $_GET))
      {
        $ban_user = $_GET["ban"];
      }
      else
        $ban_user = "none";
      if ($ban_user != "none")
      {
        $result = mysqli_query($db, "SELECT `password`, `id` FROM `users` WHERE `login`='" . $ban_user . "'");
        if (mysqli_num_rows($result) != 0)
        {
          mysqli_query($db, "UPDATE `users` SET `is_banned` = '1' WHERE `login`='" . $ban_user . "'");
          echo "<h2>Успешно!</h2>";
        }
        else
        {
          echo '<h2>Пользователя с логином ' . $ban_user . 'не существует</h2>';
        }
      }

      if (array_key_exists('unban', $_GET))
      {
        $unban_user = $_GET["unban"];
      }
      else
        $unban_user = "none";
      if ($unban_user != "none")
      {
        $result = mysqli_query($db, "SELECT `password`, `id` FROM `users` WHERE `login`='" . $unban_user . "'");
        if (mysqli_num_rows($result) != 0)
        {
          mysqli_query($db, "UPDATE `users` SET `is_banned` = '0' WHERE `login`='" . $unban_user . "'");
          echo "<h2>Успешно!</h2>";
        }
        else
        {
          echo '<h2>Пользователя с логином ' . $unban_user . 'не существует</h2>';
        }
      }

    ?>
