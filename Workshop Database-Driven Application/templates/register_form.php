<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register form</title>
</head>
<body>
<div id="p">If you have an account, you can login from <a href="login.php">HERE</a>!</div>
<form method="post">
    <h2>Register form</h2>
    Username: <input type="text" value="<?= $username; ?>" name="username"/><br>
    Password: <input type="<?= !empty($password) ? 'text' : 'password'; ?>" value="<?= $password; ?>"
                     name="password"/><br/>
    <input type="submit" value="Register">
</form>
<div id="response"><?= $response; ?></div>
</body>
</html>