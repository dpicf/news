<?php
$id = $_POST['id'];
$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
$announce = trim(filter_var($_POST['announce'], FILTER_SANITIZE_STRING));
$body = trim(filter_var($_POST['body'], FILTER_SANITIZE_STRING));
$created_at = $_POST['created_at'];

require 'errors_articles.php';
global $error;

if ($error != '') {
    echo $error;
    exit();
}

require '../connect.php';
global $pdo;

$sql = 'UPDATE articles SET title = ?, announce = ?, body = ?, created_at = ?, updated_at = ? WHERE id = ?';
$query = $pdo->prepare($sql);
$query->execute([$title, $announce, $body, $created_at, time(), $id]);

echo $id;