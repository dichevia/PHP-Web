<?php

function getAnswerByQuestionId(PDO $db, int $questionId): array
{
    $query = "
SELECT 
      a.id,
      a.body,
      a.created_on,
      u.username AS 'author_name'
FROM answers AS a
INNER JOIN users u on a.author_id = u.id
WHERE a.question_id =?
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([$questionId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function answer(PDO $db, int $questionId, int $userId, string $body)
{
    $query = "
INSERT INTO answers(body, question_id, author_id, created_on)
VALUES  ( ?, ?, ?, NOW())";

    $stmt = $db->prepare($query);
    $stmt->execute([$body, $questionId, $userId]);
}