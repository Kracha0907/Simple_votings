<?php
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'db';
 
$db = mysqli_connect($server, $user, $password, $db);
 
if (!$db) {
    echo "Не удается подключиться к серверу базы данных!"; 
    exit;
}
