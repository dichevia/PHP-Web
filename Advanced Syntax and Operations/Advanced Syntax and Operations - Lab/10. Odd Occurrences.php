<?php

$input = explode(' ', strtolower(readline()));
$output = [];

foreach ($input as $value) {
    if (!key_exists($value, $output)) {
        $output[$value] = 1;
    } else {
        $output[$value] += 1;
    }
}
$anotherStupidArray = [];
foreach ($output as $string => $occurrences) {
    if ($output[$string] % 2 !== 0) {
        $anotherStupidArray[] = $string;
    }
}

echo implode(', ', $anotherStupidArray);