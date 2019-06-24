<?php

function distance($x1, $y1, $x2, $y2)
{

    $result = sqrt(pow($x2 - $x1, 2) +
        pow($y2 - $y1, 2) * 1.0);

    if ($result == intval($result)) {
        return '{' . $x1 . ', ' . $y1 . '} to {' . $x2 . ', ' . $y2 . '} is valid';
    } else {
        return '{' . $x1 . ', ' . $y1 . '} to {' . $x2 . ', ' . $y2 . '} is invalid';
    }

}

$numbers = array_map('intval', explode(', ', readline()));

$x1 = $numbers[0];
$y1 = $numbers[1];
$x2 = $numbers[2];
$y2 = $numbers[3];

echo distance($x1, $y1, 0, 0) . PHP_EOL;
echo distance($x2, $y2, 0, 0) . PHP_EOL;
echo distance($x1, $y1, $x2, $y2) . PHP_EOL;