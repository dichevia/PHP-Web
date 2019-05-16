<?php

$name = '/(?<name>[^\d]+)/';
$phone = '/(?<phone>[\d]+)/';
$phonebook = [];

while (true) {
    $input = readline();
    if ($input === "Over") {
        break;
    }
    $args = explode(" : ", $input);
    for ($i = 0; $i < count($args); $i++) {
        $arg = $args[$i];
        if (preg_match($phone, $arg)) {
            $phoneNumber = $arg;
        }
        if (preg_match($name, $arg)) {
            $person = $arg;
        }
    }
    $phonebook[$person] = $phoneNumber;
}

ksort($phonebook);

foreach ($phonebook as $man => $contact) {
    echo "$man -> $contact" . PHP_EOL;
}