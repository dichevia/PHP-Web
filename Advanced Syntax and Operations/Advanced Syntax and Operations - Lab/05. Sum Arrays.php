<?php

$arr1 = array_map('intval', explode(' ', readline()));
$arr2 = array_map('intval', explode(' ', readline()));
$output = [];

if (count($arr1) > count($arr2)) {
    $length = count($arr1);
    $diff = $length - count($arr2);
    for ($i = 0; $i < $diff; $i++) {
        $arr2[] = $arr2[$i];
    }

} elseif (count($arr1) < count($arr2)) {
    $length = count($arr2);
    $diff = $length - count($arr1);
    for ($i = 0; $i < $diff; $i++) {
        $arr1[] = $arr1[$i];
    }
} else {
    $length = count($arr1);
}

for ($j = 0; $j < $length; $j++) {
    $output[] = $arr1[$j] + $arr2[$j];
}

echo implode(' ', $output);
