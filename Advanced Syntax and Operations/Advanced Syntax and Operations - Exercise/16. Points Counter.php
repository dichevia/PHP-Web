<?php

$teams = [];

while (true) {
    $input = readline();
    $pattern = '/[@%&$*]+/';
    if ($input === 'Result') {
        break;
    }
    $input = preg_replace($pattern, '', $input);
    $args = explode('|', $input);
    $points = $args[2];
    $teamValidate = false;
    for ($i = 0; $i < strlen($args[0]); $i++) {
        $symbol = $args[0][$i];
        if (ord($symbol) > 64 && ord($symbol) < 91) {
            $teamValidate = true;
        } else {
            $teamValidate = false;
            break;
        }
    }
    if ($teamValidate) {
        $team = $args[0];
        $player = $args[1];
    } else {
        $team = $args[1];
        $player = $args[0];
    }
    if (!key_exists($team, $teams)) {
        $teams[$team][$player] = $points;
    } else {
        if (!key_exists($player, $teams[$team])) {
            $teams[$team][$player] = $points;
        } else {
            $teams[$team][$player] = $points;
        }
    }
}
$teamPoints = [];
foreach ($teams as $team => $players) {
    $sum = array_sum($players);
    $teamPoints[$team] = $sum;
}
arsort($teamPoints);

foreach ($teamPoints as $team => $points) {
    echo "$team => $points" . PHP_EOL;
    arsort($teams[$team]);
    foreach ($teams[$team] as $player => $playerPoints) {
        echo "Most points scored by $player" . PHP_EOL;
        break;
    }
}