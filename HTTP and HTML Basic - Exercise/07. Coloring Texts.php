<form><label>
        <textarea name="input"></textarea>
    </label><br>
    <input type="submit" value="Color text"/>
</form>

<?php
if (isset($_GET['input'])) {
    $input = $_GET['input'];
}
$text = str_replace(' ', '', $input);

for ($i = 0; $i < strlen($text); $i++) {
    $letter = $text[$i];
    if (ord($letter) % 2 == 0) {
        echo "<span style='color: red'>$letter</span> ";
    } else {
        echo "<span style='color: blue'>$letter</span> ";
    }
}

?>

