<?php

$size = explode(', ', readline());
$rowSize = $size[0];
$colSize = $size[1];
$matrix = [];
$sum = 0;
for ($row = 0; $row < $rowSize; $row++) {
    $colon = explode(', ', readline());
    for ($col = 0; $col < $colSize; $col++) {
        $matrix[$row][$col] = $colon[$col];
        $sum += intval($colon[$col]);
    }
}

echo $rowSize . PHP_EOL;
echo $colSize . PHP_EOL;
echo $sum;