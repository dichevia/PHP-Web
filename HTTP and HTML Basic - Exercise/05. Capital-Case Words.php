<?php

$arr = [];
if (isset($_GET['text'])) {
    $text = $_GET['text'];
}
$text = preg_split('/[\W]/', $text);
foreach ($text as $element) {
    $element = trim($element);
    $bigCase = false;
    for ($i = 0; $i < strlen($element); $i++) {
        if (ord($element[$i]) >= 65 && ord($element[$i]) <= 90) {
            $bigCase = true;
        } else {
            $bigCase = false;
            break;
        }
    }
    if ($bigCase) {
        $arr[] = $element;
    }
}
$arr = array_filter($arr);
$arr = implode(', ', $arr)
?>

<form>
    <label>
        <textarea rows="10" name="text"><?= $arr ?></textarea>
    </label><br>
    <input type="submit" value="Extract">
</form>
