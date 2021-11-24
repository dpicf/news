<?php

function show_date($article): string
{
    $date = date('d ', $article->created_at);
    $months = ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа",
        "Сентября", "Октября", "Ноября", "Декабря"];
    $date .= $months[date('n', $article->created_at) - 1];
    $date .= date(' H:i', $article->created_at);
    return $date;
}

