<?php


namespace TopCarBundle\Service\Messages;


use TopCarBundle\Entity\Message;

interface MessageServiceInterface
{
    public function create($recipientId, Message $message);
}