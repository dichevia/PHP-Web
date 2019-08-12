<?php

namespace TopCarBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use TopCarBundle\Entity\Message;
use TopCarBundle\Form\MessageType;
use TopCarBundle\Service\Messages\MessageServiceInterface;

class MessageController extends Controller
{
    /**
     * @var MessageServiceInterface
     */
    private $messageService;

    /**
     * MessageController constructor.
     * @param MessageServiceInterface $messageService
     */
    public function __construct(MessageServiceInterface $messageService)
    {
        $this->messageService = $messageService;
    }


    /**
     * @param $id
     * @param Request $request
     *
     * @Route("user/{id}", methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return Response
     * @throws \Exception
     */
    public function send($id, Request $request)
    {
        $message = new Message();

        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        $this->messageService->create($id, $message);
        $this->addFlash('success', 'Message sent successfully!');

        return $this->redirectToRoute('user_profile', ['id' => $id]);
    }
}
