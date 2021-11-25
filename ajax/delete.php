<?php
$id = $_POST['id'];

require_once '../connect.php';
global $pdo;

$sql = 'DELETE FROM `articles` WHERE `id` = :id';
$query = $pdo->prepare($sql);
$query->execute(['id' => $id]);

echo 'Готово';