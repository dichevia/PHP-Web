<?php

$months = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
$lastDays = 0;
for ($j = 0; $j < count($months); $j++):
    ?>
    <div>
        <table border="1">
            <thead>
            <tr>
                <td>Пн</td>
                <td>Вт</td>
                <td>Ср</td>
                <td>Чт</td>
                <td>Пе</td>
                <td>Сб</td>
                <td style="color: red">Не</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $weeks = 1;
            $day = 1;
            if ($j == 0) {
                $count = ($months[$j]) + $lastDays;
            } else {
                $count = ($months[$j]) + $lastDays - 1;
            }
            for ($i = 1; $i <= $count; $i++) {
                if ($i == 1) {
                    echo "<tr>";
                }
                if ($lastDays >= $i) {
                    echo "<td></td>";
                    $day = 1;
                    if ($i == $lastDays - 1) {
                        $lastDays = 0;
                    }
                } else {
                    if ($i % 7 == 0 && $i != 0) {
                        $weeks++;
                        echo "<td>$day</td></tr><tr>";
                    } else {
                        echo "<td>$day</td>";
                    }
                    if ($weeks == 5) {
                        $lastDays++;
                    } elseif ($weeks > 5) {
                        $lastDays = 1;
                    }
                    $day++;
                }
                if ($weeks == 6) {
                    if ($j == 6) {
                        $lastDays++;
                    }
                    $lastDays++;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
<?php endfor; ?>

<?php


