<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login form</title>
</head>
<body>
If you don't have an account, you can register from <a href="register.php">HERE</a>!
<h2>Login form</h2>
<form method="post">
    Username:<input type="text" value="<?= $username; ?>" name="username"/><br>
    Password:<input type="<?= !empty($password) ? 'text' : 'password' ?>" value="<?= $password ?>" name="password"/><br>
    <input type="submit" value="Log in"/>
</form>
<div id="response"><?= $response; ?></div>
</body>
</html>