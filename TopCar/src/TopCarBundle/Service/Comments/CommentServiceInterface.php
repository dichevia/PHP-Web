<?php


namespace TopCarBundle\Service\Comments;


interface CommentServiceInterface
{
    public function save($comment);

    public function findAllByDate($id);
}