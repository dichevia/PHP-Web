<?php


namespace TopCarBundle\Service\Messages;


use TopCarBundle\Entity\Message;
use TopCarBundle\Repository\Messages\MessageRepository;
use TopCarBundle\Service\Users\UserServiceInterface;

class MessageService implements MessageServiceInterface
{
    /**
     * @var MessageRepository
     */
   private $messageRepository;

    /**
     * @var UserServiceInterface
     */
   private $userService;

    /**
     * MessageService constructor.
     * @param MessageServiceInterface $messageRepository
     * @param UserServiceInterface $userService
     */
    public function __construct(MessageRepository $messageRepository, UserServiceInterface $userService)
    {
        $this->messageRepository = $messageRepository;
        $this->userService = $userService;
    }


    public function create($recipientId, Message $message)
    {
        $message->setRecipient($this->userService->findOneById($recipientId));
        $message->setSender($this->userService->currentUser());
        return $this->messageRepository->save($message);
    }
}