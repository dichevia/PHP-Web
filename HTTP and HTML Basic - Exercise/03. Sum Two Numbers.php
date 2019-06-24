<form>
    <div>First Number:</div>
    <label>
        <input type="number" name="num1"/>
    </label>
    <div>Second Number:</div>
    <label>
        <input type="number" name="num2"/>
    </label>
    <div><input type="submit"/></div>

</form>

<?php

if (isset($_GET['num1'], $_GET['num2'])){
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];
}
$result = $num1+$num2;
echo "$num1 + $num2 = $result";
