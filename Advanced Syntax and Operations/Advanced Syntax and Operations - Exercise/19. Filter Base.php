<?php

$databaseAge = [];
$databaseSalary = [];
$databasePosition = [];

while (true) {
    $input = readline();
    if ($input === 'filter base') {
        break;
    }
    $args = explode(' -> ', $input);
    $name = $args[0];
    if (filter_var($args[1], FILTER_VALIDATE_INT)) {
        $age = $args[1];
        $databaseAge[$name] = $age;
    } elseif (filter_var($args[1], FILTER_VALIDATE_FLOAT)) {
        $salary = $args[1];
        $databaseSalary[$name] = number_format($salary, 2, '.', '');
    } else {
        $position = $args[1];
        $databasePosition[$name] = $position;
    }
}

$case = readline();

if ($case === 'Age') {
    foreach ($databaseAge as $person => $age) {
        echo "Name: $person" . PHP_EOL;
        echo "Age: $age" . PHP_EOL;
        echo "====================" . PHP_EOL;
    }
} elseif ($case === 'Salary') {
    foreach ($databaseSalary as $person => $salary) {
        echo "Name: $person" . PHP_EOL;
        echo "Salary: $salary" . PHP_EOL;
        echo "====================" . PHP_EOL;
    }
} elseif ($case === 'Position') {
    foreach ($databasePosition as $person => $position) {
        echo "Name: $person" . PHP_EOL;
        echo "Position: $position" . PHP_EOL;
        echo "====================" . PHP_EOL;
    }
}