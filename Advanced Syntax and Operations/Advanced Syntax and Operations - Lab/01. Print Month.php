<?php

$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

$month = intval(readline());

if ($month > 0 && $month < 13) {
    echo $months[$month - 1];
} else {
    echo "Invalid Month!";
}
