<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<?php /** @var array $errors */ ?>
<?php /** @var \App\Data\UserDTO $data */ ?>

<body>
<h1>LOGIN</h1>

<?php if ($data != ""): ?>
    <p style="color: green">
        Congratulation, <?= $data ?>. Login in our platform!
    </p>
<?php endif; ?>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post">
    <label>
        Username: <input type="text" name="username"
                         value="<?= isset($_POST['username']) ? $_POST['username'] : null ?>"/> <br/>
    </label>
    <label>
        Password: <input type="password" name="password" value=""/> <br/>
    </label>
    <label>
        <input type="submit" name="login" value="Login"/>
    </label>
</form>

<br>
Back to <a href=".">index</a> page!

</body>
</html>