<?php

$phonebook = [];

while (true) {
    $input = readline();
    if ($input === 'END') {
        break;
    }
    $args = explode(' ', $input);
    $command = $args[0];
    $name = $args[1];
    if ($command === 'A') {
        $phone = $args[2];
        $phonebook[$name] = $phone;
    }
    if ($command === 'S') {
        if (!key_exists($name, $phonebook)) {
            echo "Contact $name does not exist." . PHP_EOL;
        } else {
            echo "$name -> $phonebook[$name]" . PHP_EOL;
        }
    }
}