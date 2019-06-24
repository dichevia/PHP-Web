<?php

if (isset($_GET['lines'])) {
    $lines = $_GET['lines'];
}
$lines = explode(PHP_EOL, $lines);
$sortedLines = asort($lines);
$sortedLines = implode(PHP_EOL, $lines);

?>

<form>
    <label>
        <textarea rows="10" name="lines"><?= $sortedLines ?></textarea>
    </label><br>
    <input type="submit" value="Sort">
</form>


