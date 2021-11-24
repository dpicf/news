<?php
$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

$error = '';
if (strlen($username) <= 3) {
    $error = 'Введите имя больше трёх символов';
} elseif (strlen($email) <= 3) {
    $error = 'Введите email больше трёх символов';
} elseif (strlen($login) <= 3) {
    $error = 'Введите логин больше трёх символов';
} elseif (strlen($password) <= 3) {
    $error = 'Введите пароль больше трёх символов';
}

if ($error != '') {
    echo $error;
    exit();
}

$hash = "d54hd;fkh%^dh794fj";
$password = md5($password . $hash);

require '../connect.php';
global $pdo;

$sql = 'INSERT INTO users(name, email, login, password) VALUES(?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$username, $email, $login, $password]);

echo 'Готово';