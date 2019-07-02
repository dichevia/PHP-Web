<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My items</title>
</head>

<?php /** @var \App\Data\ItemDTO[] $data */ ?>

<body>
<h1>MY ITEMS</h1>

<a href="add_item.php">Add new item</a> |
<a href="profile.php">My Profile</a> |
<a href="logout.php">Logout</a>

<br/><br/>

<table border="1">
    <thead>
    <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Price</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $itemDTO): ?>
        <tr>
            <td><?= $itemDTO->getTitle(); ?></td>
            <td><?= $itemDTO->getCategory()->getName(); ?></td>
            <td><?= $itemDTO->getPrice(); ?></td>
            <td><a href="edit_item.php?id=<?= $itemDTO->getId(); ?>">edit item</a></td>
            <td><a href="delete_item.php?id=<?= $itemDTO->getId(); ?>">delete item</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>