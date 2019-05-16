<?php

$n = intval(readline());
$matrix = [];
$sumDiag1 = 0;
$sumDiag2 = 0;

for ($row = 0; $row < $n; $row++) {
    $colon = explode(' ', readline());
    for ($col = 0; $col < $n; $col++) {
        $matrix[$row][$col] = $colon[$col];
        if ($row === $col) {
            $sumDiag1 += $colon[$col];
        }
    }
}

for ($row = 0; $row < $n; $row++) {
    for ($col = $n - 1; $col >= 0; $col--) {
        $sumDiag2 += $matrix[$row][$col - $row];
        break;
    }
}

echo abs($sumDiag1 - $sumDiag2);