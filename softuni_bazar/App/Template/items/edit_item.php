<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
</head>

<?php /** @var \App\Data\EditItemDTO $data */ ?>
<?php /** @var array $errors |null */ ?>

<body>
<h1>EDIT ITEM</h1>

<a href="profile.php">My Profile</a><br/><br/>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post">
    Title: <label>
        <input type="text" name="title" value="<?= $data->getItem()->getTitle(); ?>"/>
    </label> <br/>
    Price: <label>
        <input type="text" name="price" value="<?= $data->getItem()->getPrice(); ?>"/>
    </label><br/>
    Category: <label>
        <select name="category_id"><br/>
            <?php foreach ($data->getCategory() as $category): ?>
                <?php if ($data->getItem()->getCategory()->getId() === $category->getId()): ?>
                    <option selected="selected" value="<?= $category->getId(); ?>"><?= $category->getName(); ?></option>
                <?php else: ?>
                    <option value="<?= $category->getId(); ?>"><?= $category->getName(); ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </label><br/>
    Description: <label>
        <textarea rows="5" name="description"><?= $data->getItem()->getDescription(); ?></textarea>
    </label><br/>
    Image URL: <label>
        <input type="text" name="image_url" value="<?= $data->getItem()->getImageURL(); ?>"/>
    </label><br/>

    <img src="<?= $data->getItem()->getImageURL(); ?>" alt="None"/><br/>
    <input type="submit" value="Edit" name="edit"/><br/>
</form>

</body>
</html>