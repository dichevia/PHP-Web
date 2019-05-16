<?php

$numbers = explode(' ', readline());
$length = 0;
$startPosition = 0;
for ($i = 0; $i < count($numbers); $i++) {
    $currLen = 0;
    for ($j = $i; $j < count($numbers); $j++) {
        if ($numbers[$i] == $numbers[$j]) {
            $currLen++;
            if ($currLen > $length) {
                $length = $currLen;
                $startPosition = $i;
            }
        } else {
            break;
        }
    }
}

for ($i = 0; $i < $length; $i++) {
    echo $numbers[$i + $startPosition] . ' ';
}