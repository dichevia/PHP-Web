<?php

$arguments = readline();
TripLength($arguments);

function TripLength($arguments){
    $arguments = explode(', ', $arguments);

    $x1 = $arguments[0];
    $y1 = $arguments[1];
    $x2 = $arguments[2];
    $y2 = $arguments[3];
    $x3 = $arguments[4];
    $y3 = $arguments[5];

    $distanceOneTwo = sqrt(pow(($x2 - $x1), 2) + pow($y2 - $y1, 2));
    $distanceOneThree = sqrt(pow($x3 - $x1, 2) + pow($y3 - $y1, 2));
    $distanceTwoThree = sqrt(pow($x3 - $x2, 2) + pow($y3 - $y2, 2));

    if (($distanceOneTwo <= $distanceOneThree) && ($distanceOneThree >= $distanceTwoThree)) {
        $finalDistance = $distanceOneTwo + $distanceTwoThree;
        echo("1->2->3: " . $finalDistance);
    } elseif (($distanceOneTwo <= $distanceTwoThree) && ($distanceOneThree <= $distanceTwoThree)) {
        $finalDistance = $distanceOneThree + $distanceOneTwo;
        echo("2->1->3: " . $finalDistance);
    } else {
        $finalDistance = $distanceTwoThree + $distanceOneThree;
        echo("1->3->2: " . $finalDistance);
    }

}
