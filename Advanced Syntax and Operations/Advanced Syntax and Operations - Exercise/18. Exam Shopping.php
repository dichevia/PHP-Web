<?php

$products = [];

while (true) {
    $input = readline();
    if ($input === 'shopping time') {
        break;
    }
    list($command, $product, $quantity) = explode(' ', $input);
    if ($command === 'stock') {
        if (!key_exists($product, $products)) {
            $products[$product] = $quantity;
        } else {
            $products[$product] += $quantity;
        }
    }
}

while (true) {
    $input = readline();
    if ($input === 'exam time') {
        break;
    }
    list($command, $product, $quantity) = explode(' ', $input);
    if ($command === 'buy') {
        if (key_exists($product, $products)) {
            if ($products[$product] > 0) {
                $products[$product] -= $quantity;
                if ($products[$product] <= 0) {
                    $products[$product] = 0;
                }
            } else {
                echo "$product out of stock" . PHP_EOL;
            }

        } else {
            echo "$product doesn't exist" . PHP_EOL;
        }
    }
}

foreach ($products as $product => $quantity) {
    if ($quantity !== 0) {
        echo "$product -> $quantity" . PHP_EOL;
    }
}