<?php

function show_date($time): string
{
    $date = date('d ', $time);
    $months = ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа",
        "Сентября", "Октября", "Ноября", "Декабря"];
    $date .= $months[date('n', $time) - 1];
    $date .= date(' H:i', $time);
    return $date;
}

