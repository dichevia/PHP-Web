<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
</head>
<body>
<?php include_once "logged_in_header.php" ?>
|
<table border="2">
    <thead>
    <tr>
        <th>Name</th>
        <th>Questions Count</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $category): ?>
        <tr>
            <td>
                <a href="<?= url("category.php?id={$category['id']}"); ?>">
                    <?= $category['name']; ?>
                </a>
            </td>
            <td><?= $category['questions_count']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>