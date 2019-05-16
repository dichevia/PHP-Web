<?php

$n = intval(readline());
$k = intval(readline());

$numbers = array_fill(0, $n, 0);
$numbers[0] = 1;

for ($currEl = 1; $currEl < $n; $currEl++) {
    $startIndex = max(0, $currEl - $k);
    $sum = 0;
    for ($i = $startIndex; $i < $currEl; $i++) {
        $sum += $numbers[$i];
    }
    $numbers[$currEl] = $sum;
}

echo implode(' ', $numbers);