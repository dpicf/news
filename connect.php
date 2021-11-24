<?php
$user = 'root';
$passDB = '';
$db = 'news';
$host = 'localhost';

$dsn = 'mysql:host='.$host.';dbname='.$db;
$pdo = new PDO($dsn, $user, $passDB);
