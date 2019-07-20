<?php

namespace TopCarBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\ORMException;
use TopCarBundle\Entity\User;


/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function __construct(EntityManagerInterface $em, Mapping\ClassMetadata $metadata = null)
    {
        parent::__construct($em,
            $metadata == null ?
                new Mapping\ClassMetadata(User::class) :
                $metadata
        );
    }

    public function insert($user)
    {
        try {
            $this->_em->persist($user);
            $this->_em->flush();
            return true;
        } catch (ORMException $e) {
            return false;
        }
    }
}
