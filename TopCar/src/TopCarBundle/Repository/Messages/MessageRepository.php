<?php

namespace TopCarBundle\Repository\Messages;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\ORMException;
use TopCarBundle\Entity\Message;

/**
 * MessageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MessageRepository extends \Doctrine\ORM\EntityRepository
{
    public function __construct(EntityManagerInterface $em, Mapping\ClassMetadata $metadata = null)
    {
        parent::__construct($em,
            $metadata == null ?
                new Mapping\ClassMetadata(Message::class) :
                $metadata
        );
    }

    public function save(Message $message)
    {
        try {
            $this->_em->persist($message);
            $this->_em->flush();
            return true;
        } catch (ORMException $e) {
            return false;
        }
    }
}