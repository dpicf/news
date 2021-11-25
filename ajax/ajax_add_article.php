<?php
$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
$announce = trim(filter_var($_POST['announce'], FILTER_SANITIZE_STRING));
$body = trim(filter_var($_POST['body'], FILTER_SANITIZE_STRING));

require_once 'errors_articles.php';
global $error;

if ($error != '') {
    echo $error;
    exit();
}

require_once '../connect.php';
global $pdo;

$sql = 'INSERT INTO articles(title, announce, body, created_at, updated_at) VALUES(?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$title, $announce, $body, time(), time()]);

echo $pdo->lastInsertId();