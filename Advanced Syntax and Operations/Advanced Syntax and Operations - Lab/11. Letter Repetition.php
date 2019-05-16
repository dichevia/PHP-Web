<?php

$string = readline();
$arr = [];

for ($i = 0; $i < strlen($string); $i++) {
    $symbol = $string[$i];
    if (!key_exists($symbol, $arr)) {
        $arr[$symbol] = 1;
    } else {
        $arr[$symbol]++;
    }
}

foreach ($arr as $letter => $count) {
    echo "$letter -> $count" . PHP_EOL;
}