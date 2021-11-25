<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

$error = '';
if (strlen($login) == 0) {
    $error = 'Введите логин';
} elseif (strlen($password) == 0) {
    $error = 'Введите пароль';
}

if ($error != '') {
    echo $error;
    exit();
}

$hash = "d54hd;fkh%^dh794fj";
$password = md5($password . $hash);

require_once '../connect.php';
global $pdo;

$sql = 'SELECT `id` FROM `users` WHERE `login` = :login && `password` = :password';
$query = $pdo->prepare($sql);
$query->execute(['login' => $login, 'password' => $password]);

$user = $query->fetch(PDO::FETCH_OBJ);
if ($user->id != 7) {
    echo 'На данный момент, вход доступен только администратору';
} else {
    setcookie('login', $login, time() + 3600 * 24 * 30, '/news/');
    echo 'Готово';
}
