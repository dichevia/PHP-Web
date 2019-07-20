<?php

namespace TopCarBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use TopCarBundle\Entity\User;
use TopCarBundle\Form\UserType;
use TopCarBundle\Service\Users\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("register", name="user_register", methods={"GET"})
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function register(Request $request)
    {
        return $this->render("user/register.html.twig",
            ['form' => $this->createForm(UserType::class)->createView()]);
    }

    /**
     * @Route("register", methods={"POST"})
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function registerProcess(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $this->userService->save($user);

        return $this->redirectToRoute("user_register");
    }
}
