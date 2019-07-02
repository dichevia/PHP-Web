<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All items</title>
</head>

<?php /** @var \App\Data\ItemDTO[] $data */ ?>
<?php /** @var array $errors |null */ ?>

<body>

<h1>ALL ITEMS</h1>

<a href="add_item.php">Add new item</a> |
<a href="profile.php">My Profile</a> |
<a href="logout.php">Logout</a>

<br/><br/>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<table border="1">
    <thead>
    <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Price</th>
        <th>Username</th>
        <th>Location</th>
        <th>Phone</th>
        <th>Details</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $itemDTO): ?>
        <tr>
            <td><?= $itemDTO->getTitle(); ?></td>
            <td><?= $itemDTO->getCategory()->getName(); ?></td>
            <td><?= $itemDTO->getPrice(); ?></td>
            <td><?= $itemDTO->getUser()->getUsername(); ?></td>
            <td><?= $itemDTO->getUser()->getLocation(); ?></td>
            <td><?= $itemDTO->getUser()->getPhone(); ?></td>
            <td><a href="view_item.php?id=<?= $itemDTO->getId(); ?>">Details</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>