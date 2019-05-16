<?php

$input = explode(' ', readline());
$output = [];

foreach ($input as $number) {
    if (!key_exists($number, $output)) {
        $output[$number] = 1;
    } else {
        $output[$number]++;
    }
}
ksort($output);
foreach ($output as $num => $ocurr) {
    echo "$num -> $ocurr" . PHP_EOL;
}