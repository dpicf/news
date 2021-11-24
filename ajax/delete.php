<?php
$id = $_POST['id'];

require '../connect.php';
global $pdo;

$sql = 'DELETE FROM `articles` WHERE `id` = :id';
$query = $pdo->prepare($sql);
$query->execute(['id' => $id]);

echo 'Готово';