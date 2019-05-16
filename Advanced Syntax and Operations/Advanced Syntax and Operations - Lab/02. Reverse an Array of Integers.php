<?php

$n = intval(readline());
$arr = [];

for ($i = 0; $i < $n; $i++) {
    $arr[] = intval(readline());
}

for ($j = $n - 1; $j >= 0; $j--) {
    echo $arr[$j] . ' ';
}