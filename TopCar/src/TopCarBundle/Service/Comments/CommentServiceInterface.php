<?php


namespace TopCarBundle\Service\Comments;


interface CommentServiceInterface
{
    public function save($comment, $id);

    public function findAllByDate($id);

    public function findAllByUser($id);
}