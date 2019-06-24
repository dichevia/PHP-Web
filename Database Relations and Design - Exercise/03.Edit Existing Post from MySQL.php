<?php

$mysql = new mysqli('localhost', 'root', '', 'blog');
$mysql->set_charset("utf8");
if (isset($_GET['id'])){
    $st = $mysql->prepare("UPDATE title FROM posts WHERE id=?");
    $st->bind_param("i", $_GET['id']);
    $st->execute();
    if ($st->affected_rows==1) echo "Post edited.";
}

$result = $mysql->query('SELECT id, title FROM posts');
while ($row=$result->fetch_assoc()){
    $title = htmlspecialchars($row['title']);
    $editLink = 'delete-post.php?id='.$row['id'];
    echo "<p><a href='$editLink'>Edit post '$title'</a></p>";
}