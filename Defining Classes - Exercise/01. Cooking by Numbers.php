<?php

function chop1($number)
{
    return $number / 2;
}

function dice1($number)
{
    return sqrt($number);
}

function spice1($number)
{
    return $number + 1;
}

function bake1($number)
{
    return $number * 3;
}

function fillet1($number)
{
    return $number - (0.2 * $number);
}

$num = intval(readline());
$functions = explode(', ', readline());

for ($i = 0; $i < count($functions); $i++) {
    $function = $functions[$i];
    switch ($function) {
        case 'chop':
            $num = chop1($num);
            echo $num . PHP_EOL;
            break;
        case 'dice':
            $num = dice1($num);
            echo $num . PHP_EOL;
            break;
        case 'spice':
            $num = spice1($num);
            echo $num . PHP_EOL;
            break;
        case 'bake':
            $num = bake1($num);
            echo $num . PHP_EOL;
            break;
        case 'fillet':
            $num = fillet1($num);
            echo $num . PHP_EOL;
            break;
    }
}
