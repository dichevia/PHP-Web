<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Question</title>
</head>
<body>
<?php include_once "logged_in_header.php" ?>
|
<a href="<?= url("category.php?id={$question['category_id']}") ?>">Back</a>
<div class="question">
    <hr>
    <span>
    Title: <?= htmlspecialchars($question['title']) ?>
</span><br><br>
    <span><?= htmlspecialchars($question['body']) ?></span><br><br>
    Asked by <span><?= htmlspecialchars($question['author_name']) ?></span>
    <span><?= $question['created_on'] ?></span>
    <span><?= $question['category_name'] ?></span>
    <hr>
</div>
<div>
    <hr>
    <?php foreach ($answers as $answer): ?>

        Answered by <span><?= htmlspecialchars($answer['author_name']) ?></span><br>
        <span><?= htmlspecialchars($answer['body']) ?></span>
        <hr>
    <?php endforeach; ?>
</div>
<form method="post">
    Your answer here:
    <textarea name="body"></textarea>
    <input type="submit" value="Answer!" name="answer"/>
</form>
</body>
</html>