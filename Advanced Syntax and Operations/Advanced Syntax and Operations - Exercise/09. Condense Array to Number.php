<?php

$arr = explode(' ', readline());

while (count($arr) > 1){
    for ($i = 0; $i <count($arr) -1; $i++){
        $arr[$i] = $arr[$i]+$arr[$i+1];
    }
    array_pop($arr);
}

echo implode($arr);