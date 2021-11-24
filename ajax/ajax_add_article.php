<?php
$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
$announce = trim(filter_var($_POST['announce'], FILTER_SANITIZE_STRING));
$body = trim(filter_var($_POST['body'], FILTER_SANITIZE_STRING));

$error = '';
if (strlen($title) <= 5) {
    $error = 'Введите название больше 5 символов';
} elseif (strlen($announce) <= 10) {
    $error = 'Введите анонс больше 10 символов';
} elseif (strlen($body) <= 15) {
    $error = 'Введите текст больше 15 символов';
}

if ($error != '') {
    echo $error;
    exit();
}

require '../connect.php';
global $pdo;

$sql = 'INSERT INTO articles(title, announce, body, created_at, updated_at) VALUES(?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$title, $announce, $body, time(), time()]);

echo $pdo->lastInsertId();