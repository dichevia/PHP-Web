<?php

function getAllCategories(PDO $db): array
{

    $query = "
SELECT c.id, c.name, COUNT(q.id) AS questions_count
FROM categories AS c
LEFT JOIN questions AS q
ON c.id = q.category_id
GROUP BY  c.id, c.name
ORDER BY questions_count DESC , c.name ASC 
";

    return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

function getQuestionsByCategoryId(PDO $db, int $categoryId): array
{
    $query = "
SELECT 
    q.id,
    q.title,
    q.author_id,
    q.created_on,
    u.username AS `author_name`,
    c.name AS `category_name`,
    COUNT(a.id) AS `answers_count`
FROM questions AS q
INNER JOIN users AS u
  ON q.author_id=u.id
INNER JOIN categories AS c
  ON q.category_id=c.id
LEFT JOIN answers AS a
  ON q.id=a.question_id
WHERE c.id=?
GROUP BY  
    q.id,
    q.title,
    q.author_id,
    q.created_on,
    u.username,
    c.name
ORDER BY 
    q.created_on,
    answers_count
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([$categoryId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}