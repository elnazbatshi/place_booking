<?php


if (!function_exists("convertPersianNumbersToEnglish")) {
    function convertPersianNumbersToEnglish($input)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '٦', '۶', '۷', '۸', '۹'];
        $english = [0, 1, 2, 3, 4, 4, 5, 5, 6, 6, 7, 8, 9];
        return str_replace($persian, $english, $input);
    }
}

if (!function_exists("excerpt")) {
    function excerpt($value, $index)
    {
        return (mb_strlen($value) > $index) ? mb_substr($value, 0, $index) . "..." : mb_substr($value, 0, $index);

    }
}


function getTimesDays($days)
{
    $reserve_data = collect([]);
    foreach ($days as $key => $day) {
        $items = collect([]);
        foreach ($day as $time) {
            $times = range(date('H', strtotime($time->startTime)), date('H', strtotime($time->endTime)));
            foreach ($times as $t) {
                $items->push($t);
            }
            $reserve_data->put($key, $items);
        }
    }
    return $reserve_data;
}

function getTimesDays2($days)
{
    $reserve_data = [];
    foreach ($days as $key => $day) {
        $items = collect([]);
        foreach ($day as $time) {
            $times = range(date('H', strtotime($time->startTime)), date('H', strtotime($time->endTime)));
            foreach ($times as $t) {
                $items->push($t);
            }
            array_push($reserve_data, $items);
        }
    }
    return $reserve_data;
}
