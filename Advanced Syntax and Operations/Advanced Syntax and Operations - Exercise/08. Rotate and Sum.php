<?php

$n = explode(' ', readline());
$k = intval(readline());
$output = [];

for ($i = 0; $i < $k; $i++) {
    $tempArr = $n;
    $last = array_pop($n);
    array_unshift($n, $last);
    if ($i == 1) {
        for ($j = 0; $j < count($n); $j++) {
            $output[$j] = $n[$j] + $tempArr[$j];
        }
    }
    if ($i > 1) {
        for ($j = 0; $j < count($n); $j++) {
            $output[$j] = $n[$j] + $output[$j];
        }
    }
}

if ($k == 1) {
    echo implode(' ', $n);
} else {
    echo implode(' ', $output);
}