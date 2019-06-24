<?php

$num = readline();
$num = str_split($num);

while ((array_sum($num) / count($num)) < 5) {
    $num[] = 9;
}

echo implode('', $num);