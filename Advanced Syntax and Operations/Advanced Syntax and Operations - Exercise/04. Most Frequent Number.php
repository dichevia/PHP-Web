<?php

$numbers = explode(' ', readline());
$numbers2 = [];

foreach ($numbers as $number) {
    if (!key_exists($number, $numbers2)) {
        $numbers2[$number] = 1;
    }
    $numbers2[$number] += 1;
}
$max = 0;
$max2 = 0;
foreach ($numbers2 as $key => $num) {
    if ($max < $num) {
        $max = $num;
        $max2 = $key;
    }
}

echo $max2;