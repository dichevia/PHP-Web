<form>
    Name<label>
        <input type="text" name="person"/>
    </label>
    <input type="submit" value="Submit"/>
</form>

<?php

if (isset($_GET['person'])) {
    $name = $_GET['person'];
}

echo 'Hello, ' . htmlspecialchars($name) . '!';