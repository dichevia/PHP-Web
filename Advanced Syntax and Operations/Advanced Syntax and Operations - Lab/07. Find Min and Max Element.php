<?php

$input = explode(', ', readline());
$rowSize = $input[0];
$colSize = $input[1];
$matrix = [];
$min = PHP_INT_MAX;
$max = PHP_INT_MIN;

for ($row = 0; $row < $rowSize; $row++) {
    $colon = explode(', ', readline());
    for ($col = 0; $col < $colSize; $col++) {
        $matrix[$row][$col] = $colon[$col];
        if (intval($colon[$col]) > $max) {
            $max = $colon[$col];
        }
        if (intval($colon[$col]) < $min) {
            $min = $colon[$col];
        }
    }
}

echo "Min: $min\nMax: $max";