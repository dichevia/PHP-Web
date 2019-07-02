<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Item</title>
</head>

<?php /** @var \App\Data\ItemDTO $data */ ?>

<body>
<h1>VIEW ITEM</h1>

<a href="profile.php">My Profile</a><br/>

<p><b>Title</b>: <?= $data->getTitle(); ?></p>
<p><b>Price</b>: <?= $data->getPrice(); ?></p>
<p><b>Category</b>: <?= $data->getCategory()->getName(); ?></p>
<p><b>Phone</b>: <?= $data->getUser()->getPhone(); ?></p>
<p><b>Description</b>: <?= $data->getDescription(); ?></p>

<img src="<?= $data->getImageURL(); ?>" alt="None"/>

</body>
</html>