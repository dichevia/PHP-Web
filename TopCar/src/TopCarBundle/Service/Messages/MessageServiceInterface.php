<?php


namespace TopCarBundle\Service\Messages;


use TopCarBundle\Entity\Message;

interface MessageServiceInterface
{
    public function create($recipientId, Message $message);

    public function findReceivedByUser($id);

    public function findSingleMessage($id);
}