<?php

$input = explode(', ', readline());
$output = [];

for ($i = 0; $i < count($input); $i += 2) {
    $city = $input[$i];
    $income = $input[$i + 1];
    if (!key_exists($city, $output)) {
        $output[$city] = $income;
    } else {
        $output[$city] += $income;
    }
}

foreach ($output as $city => $income) {
    echo "$city => $income" . PHP_EOL;
}