<?php

$userLogins = [];
$unsuccessful = 0;

while (true) {
    $input = readline();
    if ($input === "login") {
        break;
    }
    $args = explode(' -> ', $input);
    $user = $args[0];
    $password = $args[1];
    $userLogins[$user] = $password;
}

while (true) {
    $input = readline();
    if ($input === "end") {
        break;
    }
    $args = explode(' -> ', $input);
    $userAttempt = $args[0];
    $passwordAttempt = $args[1];
    if (key_exists($userAttempt, $userLogins)) {
        $valid = false;
        for ($i = 0; $i < strlen($passwordAttempt); $i++) {
            $symbol = $passwordAttempt[$i];
            if ($symbol === $userLogins[$userAttempt][$i]) {
                $valid = true;
            } else {
                $valid = false;
                echo "$userAttempt: login failed" . PHP_EOL;
                $unsuccessful++;
                break;
            }
        }
        if ($valid) {
            echo "$userAttempt: logged in successfully" . PHP_EOL;
        }


    } else {
        echo "$userAttempt: login failed" . PHP_EOL;
        $unsuccessful++;
    }
}

echo "unsuccessful login attempts: $unsuccessful";