<?php

namespace TopCarBundle\Repository\Messages;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\ORMException;
use TopCarBundle\Entity\Message;
use TopCarBundle\Entity\User;

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

    public function update(Message $message)
    {
        try {
            $this->_em->merge($message);
            $this->_em->flush();
            return true;
        } catch (ORMException $e) {
            return false;
        }
    }

    public function remove($message)
    {
        try {
            $this->_em->remove($message);
            $this->_em->flush();
            return true;
        } catch (ORMException $e) {
            return false;
        }
    }

    public function getReceivedByUser($id)
    {
        return $this->createQueryBuilder('m')
            ->where('m.recipient=:id')
            ->orderBy('m.createdOn', 'DESC')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getMessage($id)
    {
        return $this->createQueryBuilder('m')
            ->where('m.id=:id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }

    public function getSentByUser($id)
    {
        return $this->createQueryBuilder('m')
            ->where('m.sender=:id')
            ->orderBy('m.createdOn', 'DESC')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

}
