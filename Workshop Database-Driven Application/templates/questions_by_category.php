<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Questions</title>
</head>
<body>
<?php include_once "logged_in_header.php" ?>
|
<a href="<?= url("ask_question.php?category_id=$id") ?>">Ask new question</a>
|
<a href="<?= url("categories.php"); ?>">Back to all categories</a>
<?php foreach ($questions as $question): ?>
    <div class="question">
        <hr>
        <span>
    <a href="<?= url("question.php?id={$question['id']}") ?>"><?= htmlspecialchars($question['title']) ?></a>
</span>
        <span>(<?= $question['answers_count'] ?></span>)<br>
        <span> Created by: <b><?= htmlspecialchars($question['author_name']) ?></b></span>
        <span><?= $question['created_on'] ?></span>
        <span><?= $question['category_name'] ?></span>
    </div>
<?php endforeach; ?>
</body>
</html>