<?php

$input = explode(', ', readline());
$n = $input[0];
$pattern = $input[1];
$matrix = [];
$num = 1;

if ($pattern === 'A') {
    for ($row = 0; $row < $n; $row++) {
        for ($col = 0; $col < $n; $col++) {
            $matrix[$col][$row] = $num;
            $num++;
        }

    }
} elseif ($pattern === 'B') {
    for ($row = 0; $row < $n; $row++) {
        if ($row % 2 == 0) {
            for ($col = 0; $col < $n; $col++) {
                $matrix[$col][$row] = $num;
                $num++;
            }
        } else {
            for ($col = $n - 1; $col >= 0; $col--) {
                $matrix[$col][$row] = $num;
                $num++;
            }
        }
    }
}


for ($i = 0; $i < $n; $i++) {
    echo PHP_EOL;
    for ($j = 0; $j < $n; $j++) {
        echo $matrix[$i][$j] . ' ';
    }
}