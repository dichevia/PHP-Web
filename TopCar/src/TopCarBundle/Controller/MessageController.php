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
use TopCarBundle\Service\Users\UserServiceInterface;

class MessageController extends Controller
{
    /**
     * @var MessageServiceInterface
     */
    private $messageService;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * MessageController constructor.
     * @param MessageServiceInterface $messageService
     * @param UserServiceInterface $userService
     */
    public function __construct(MessageServiceInterface $messageService, UserServiceInterface $userService)
    {
        $this->messageService = $messageService;
        $this->userService = $userService;
    }


    /**
     * @param $id
     * @param Request $request
     *
     * @Route("user/{id}",name="send_message", methods={"POST"})
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

    /**
     * @Route("messages/received", name="received", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function allReceived()
    {
        $currentUser = $this->userService->currentUser();
        $received = $this->messageService->findReceivedByUser($currentUser);

        return $this->render("messages/received.html.twig", ['received' =>$received]);
    }

    /**
     * @param $id
     *
     * @Route("messages/received/{id}", name="view")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return Response
     */
    public function view ($id)
    {
        $message = $this->messageService->findSingleMessage($id);


        return $this->render('messages/view.html.twig',['message'=>$message]);
    }
}
