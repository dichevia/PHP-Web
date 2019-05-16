<?php

$arr = explode(' ', readline());
$sum=0;
for ($i = 0; $i <count($arr) ; $i++){
    $num = intval(strrev($arr[$i]));
    $sum += $num;
}

echo $sum;