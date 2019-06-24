<form>
    Name<label>
        <input type="text" name="name"/>
    </label><br>
    PhoneNumber<label>
        <input type="text" name="phone"/>
    </label><br>
    Age<label>
        <input type="text" name="age"/>
    </label><br>
    Address<label>
        <input type="text" name="address"/>
    </label><br>
    <input type="submit" value="Generate"/>
</form>

<?php

if (isset($_GET['name'], $_GET['phone'], $_GET['age'], $_GET['address'])) {
    $name = $_GET['name'];
    $phone = $_GET['phone'];
    $age = $_GET['age'];
    $address = $_GET['address'];
}

?>

<table border="2">
    <tr>
        <td style="background-color: orange">Name</td>
        <td><?= $name ?></td>
    </tr>
    <tr>
        <td style="background-color: orange">Phone number</td>
        <td><?= $phone ?></td>
    </tr>
    <tr>
        <td style="background-color: orange">Age</td>
        <td><?= $age ?></td>
    </tr>
    <tr>
        <td style="background-color: orange">Address</td>
        <td><?= $address ?></td>
    </tr>

</table>
