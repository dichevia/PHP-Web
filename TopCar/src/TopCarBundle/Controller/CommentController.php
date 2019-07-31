<?php

namespace TopCarBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use TopCarBundle\Entity\Comment;
use TopCarBundle\Form\CommentType;
use TopCarBundle\Service\Cars\CarServiceInterface;
use TopCarBundle\Service\Comments\CommentServiceInterface;
use TopCarBundle\Service\Users\UserServiceInterface;

class CommentController extends Controller
{
    /**
     * @var CarServiceInterface
     */
    private $carService;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var CommentServiceInterface
     */
    private $commentService;

    /**
     * CommentController constructor.
     * @param CarServiceInterface $carService
     * @param UserServiceInterface $userService
     * @param CommentServiceInterface $commentService
     */
    public function __construct(CarServiceInterface $carService,
                                UserServiceInterface $userService,
                                CommentServiceInterface $commentService)
    {
        $this->carService = $carService;
        $this->userService = $userService;
        $this->commentService = $commentService;
    }


    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     *
     * @Route("/car/view/{id}", methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function add($id, Request $request)
    {
        $car = $this->carService->findOneById($id);
        $user = $this->userService->currentUser();
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        $comment->setAuthor($user);
        $comment->setCar($car);


        $this->commentService->save($comment);

        return $this->redirectToRoute('car_view', ['id' => $id]);
    }
}
