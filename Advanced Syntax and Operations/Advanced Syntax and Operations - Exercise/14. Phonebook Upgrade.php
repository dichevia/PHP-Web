<?php

$phonebook = [];

while (true) {
    $input = readline();
    if ($input === 'END') {
        break;
    }
    $args = explode(' ', $input);
    $command = $args[0];
    if ($command === 'A') {
        $name = $args[1];
        $phone = $args[2];
        $phonebook[$name] = $phone;
    }
    if ($command === 'S') {
        $name = $args[1];
        if (!key_exists($name, $phonebook)) {
            echo "Contact $name does not exist." . PHP_EOL;
        } else {
            echo "$name -> $phonebook[$name]" . PHP_EOL;
        }
    }
    if ($command === 'ListAll'){
        ksort($phonebook);
        foreach ($phonebook as $person=>$contact){
            echo "$person -> $contact" . PHP_EOL;
        }
    }
}