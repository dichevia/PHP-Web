<?php

$size = explode(' ', readline());
$rowSize = $size[0];
$colSize = $size[1];
$matrix = [];
$sum = PHP_INT_MIN;
$result = [];

for ($i = 0; $i < $rowSize; $i++) {
    $colon = explode(' ', readline());
    for ($j = 0; $j < $colSize; $j++) {
        $matrix[$i][$j] = intval($colon[$j]);
    }
}

for ($row = 0; $row < $rowSize - 2; $row++) {
    for ($col = 0; $col < $colSize - 2; $col++) {
        $currSum = 0;
        $currSum += $matrix[$row][$col] + $matrix[$row][$col + 1] + $matrix[$row][$col + 2];
        $currSum += $matrix[$row + 1][$col] + $matrix[$row + 1][$col + 1] + $matrix[$row + 1][$col + 2];
        $currSum += $matrix[$row + 2][$col] + $matrix[$row + 2][$col + 1] + $matrix[$row + 2][$col + 2];
        if ($currSum > $sum) {
            $sum = $currSum;
            for ($m = 0; $m < 3; $m++) {
                for ($n = 0; $n < 3; $n++) {
                    $result[$m][$n] = $matrix[$row + $m][$col + $n];
                }
            }
        }
    }
}

echo "Sum = $sum" . PHP_EOL;
foreach ($result as $num) {
    echo implode(' ', $num) . PHP_EOL;
}