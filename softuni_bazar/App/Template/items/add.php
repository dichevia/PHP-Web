<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
</head>

<?php /** @var \App\Data\CategoryDTO[] $data */ ?>
<?php /** @var array $errors |null */ ?>

<body>
<h1>ADD ITEM</h1>

<a href="profile.php">My Profile</a><br/><br/>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post">
    Title: <label>
        <input type="text" name="title"/>
    </label> <br/>
    Price: <label>
        <input type="text" name="price"/>
    </label><br/>
    Category: <label>
        <select name="category_id"><br/>
            <?php foreach ($data as $category): ?>
                <option value="<?= $category->getId(); ?>">
                    <?= $category->getName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br/>
    Description: <label>
        <textarea rows="5" name="description"></textarea>
    </label><br/>
    Image URL: <label>
        <input type="text" name="image_url"/>
    </label><br/>
    <input type="submit" value="Add" name="add"/><br/>
</form>

</body>
</html>