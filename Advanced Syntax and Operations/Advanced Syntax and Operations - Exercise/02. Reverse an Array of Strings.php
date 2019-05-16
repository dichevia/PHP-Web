<?php

$arr = explode(' ', readline());

for ($i = count($arr) - 1; $i >= 0; $i--) {
    echo $arr[$i] . ' ';
}