<?php

$helix = 'ATCGTTAGGG';

$n = intval(readline());
if ($n > 5) {
    $helix = str_repeat($helix, $n);
}
$counter = 0;
for ($i = 0; $i < $n * 2; $i += 2) {

    $j = $i + 1;

    if ($i == 0) {
        echo "**$helix[$i]$helix[$j]**\n";
    } else {
        if ($i % 8 == 0) {
            echo "**$helix[$i]$helix[$j]**\n";
        } elseif ($i % 6 == 0) {
            echo "*$helix[$i]--$helix[$j]*\n";
        } elseif ($i % 4 == 0) {
            echo "$helix[$i]----$helix[$j]\n";
        } elseif ($i % 2 == 0) {
            echo "*$helix[$i]--$helix[$j]*\n";
        }
    }
    $counter++;
    if ($counter == $n) {
        break;
    }
    if ($i == 8) {
        $i = 0;
        $helix = substr($helix, 8);
    }
}