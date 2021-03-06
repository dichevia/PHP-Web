<?php

namespace TopCarBundle\Repository\Comments;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\ORMException;
use TopCarBundle\Entity\Comment;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{

    public function __construct(EntityManagerInterface $em, Mapping\ClassMetadata $metadata = null)
    {
        parent::__construct($em,
            $metadata == null ?
                new Mapping\ClassMetadata(Comment::class) :
                $metadata
        );
    }

    public function insert($comment)
    {
        try {
            $this->_em->persist($comment);
            $this->_em->flush();
            return true;
        } catch (ORMException $e) {
            return false;
        }
    }

    public function update($comment)
    {
        try {
            $this->_em->merge($comment);
            $this->_em->flush();
            return true;
        } catch (ORMException $e) {
            return false;
        }
    }

    public function remove($comment)
    {
        try {
            $this->_em->remove($comment);
            $this->_em->flush();
            return true;
        } catch (ORMException $e) {
            return false;
        }
    }

    public function getAllByDate($id)
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.dateAdded', 'DESC')
            ->where('c.car =:id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    public function getAllByUser($id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.author=:id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}
