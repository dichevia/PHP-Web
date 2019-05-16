<?php

$letters = strtolower(readline());

for ($i = 0; $i < strlen($letters); $i++) {
    echo $letters[$i] . ' -> ' . (ord($letters[$i]) - 97) . PHP_EOL;
}