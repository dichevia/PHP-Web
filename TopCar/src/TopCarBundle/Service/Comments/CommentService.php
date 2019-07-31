<?php


namespace TopCarBundle\Service\Comments;


use TopCarBundle\Repository\Comments\CommentRepository;

class CommentService implements CommentServiceInterface
{
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * CommentService constructor.
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }


    public function save($comment)
    {
        return $this->commentRepository->insert($comment);
    }

    public function findAllByDate($id)
    {
        return $this->commentRepository->getAllByDate($id);
    }
}