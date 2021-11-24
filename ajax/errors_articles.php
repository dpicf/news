<?php

$error = '';
if (strlen($title) <= 5) {
    $error = 'Введите название больше 5 символов';
} elseif (strlen($announce) <= 10) {
    $error = 'Введите анонс больше 10 символов';
} elseif (strlen($body) <= 15) {
    $error = 'Введите текст больше 15 символов';
}