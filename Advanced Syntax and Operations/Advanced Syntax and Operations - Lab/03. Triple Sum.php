<?php

$arr = array_map('intval', explode(' ', readline()));
$no = false;
for ($i = 0; $i < count($arr); $i++) {
    for ($j = $i + 1; $j < count($arr); $j++) {
        for ($k = 0; $k < count($arr); $k++) {
            if ($arr[$i] + $arr[$j] === $arr[$k]) {
                $no = true;
                echo "$arr[$i] + $arr[$j] == $arr[$k]" . PHP_EOL;
            }
        }
    }
}

if (!$no) {
    echo 'No';
}