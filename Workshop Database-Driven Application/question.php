<?php

require_once "common.php";

if (!isset($_GET['id'])) {
    header("Location:" . url("categories.php"));
    exit;
}

$id = $_GET['id'];

require_once "db/question_queries.php";
require_once "db/answer_queries.php";

$question = getQuestionById($db, $id);
$answers = getAnswerByQuestionId($db, $id);


if (isset($_POST['answer'])) {
    $body = $_POST['body'];
    answer($db, $id, $userId, $body);
    header("Location:" . url("question.php?id=$id"));
}
require_once "templates/question.php";
