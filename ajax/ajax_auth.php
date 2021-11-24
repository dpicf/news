<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

$hash = "d54hd;fkh%^dh794fj";
$password = md5($password . $hash);

require '../connect.php';
global $pdo;

$sql = 'SELECT `id` FROM `users` WHERE `login` = :login && `password` = :password';
$query = $pdo->prepare($sql);
$query->execute(['login' => $login, 'password' => $password]);

$user = $query->fetch(PDO::FETCH_OBJ);
if ($user->id == 0) {
    echo 'Такого пользователя не существует';
} else {
    setcookie('login', $login, time() + 3600 * 24 * 30, '/news/');
    echo 'Готово';
}
