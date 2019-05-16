<?php

$size = explode(', ', readline());
$rowSize = $size[0];
$colSize = $size[1];
$matrix = [];
$sum = 0;
$result = [];

for ($i = 0; $i < $rowSize; $i++) {
    $colon = explode(', ', readline());
    for ($j = 0; $j < $colSize; $j++) {
        $matrix[$i][$j] = $colon[$j];
    }
}
for ($row = 0; $row < $rowSize - 1; $row++) {

    for ($col = 0; $col < $colSize - 1; $col++) {
        $currSum = 0;
        $currSum += $matrix[$row][$col] + $matrix[$row][$col + 1] + $matrix[$row + 1][$col] + $matrix[$row + 1][$col + 1];
        if ($currSum > $sum) {
            $sum = $currSum;
            for ($m = 0; $m < 2; $m++) {
                for ($n = 0; $n < 2; $n++) {
                    $result[$m][$n] = $matrix[$row + $m][$col + $n];
                }
            }
        }
    }

}

foreach ($result as $num) {
    echo implode(' ', $num) . PHP_EOL;
}
echo $sum;