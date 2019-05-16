<?php

$input = explode(', ', readline());
$output = [];

foreach ($input as $element) {
    if (!key_exists($element, $output)) {
        $output[$element] = 1;
    } else {
        $output[$element] += 1;
    }
}

foreach ($output as $key => $value) {
    if ($value == 1) {
        echo "$key ";
    }
}