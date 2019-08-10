<?php

namespace TopCarBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use TopCarBundle\Entity\User;
use TopCarBundle\Form\AvatarType;
use TopCarBundle\Form\UserType;
use TopCarBundle\Service\Comments\CommentServiceInterface;
use TopCarBundle\Service\ImageUploader\AvatarUploader;
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
    /**
     * @var AvatarUploader
     */
    private $avatarUploader;
    /**
     * @var CommentServiceInterface
     */
    private $commentService;

    /**
     * UserController constructor.
     * @param UserServiceInterface $userService
     * @param AvatarUploader $avatarUploader
     * @param CommentServiceInterface $commentService
     */
    public function __construct(UserServiceInterface $userService,
                                AvatarUploader $avatarUploader,
                                CommentServiceInterface $commentService)
    {
        $this->userService = $userService;
        $this->avatarUploader = $avatarUploader;
        $this->commentService = $commentService;
    }

    /**
     * @Route("register", name="user_register", methods={"GET"})
     *
     * @return RedirectResponse|Response
     */
    public function register()
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

        if (!$form->isValid()) {

            return $this->render("user/register.html.twig",
                ['form' => $form->createView(), 'errors' => $form->getErrors()]);
        }
        $this->userService->save($user);

        return $this->redirectToRoute("security_login");
    }

    /**
     * @Route("user/profile", name="user_profile", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function profile()
    {
        $user = $this->userService->currentUser();

        return $this->render('user/profile.html.twig', ['user' => $user,
            'form' => $this->createForm(AvatarType::class, $user)->createView()]);
    }

    /**
     * @Route("user/profile", methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @return Response
     */
    public function uploadAvatar(Request $request)
    {
        $form = $this->createForm(AvatarType::class, $this->userService->currentUser());
        $form->handleRequest($request);
        $avatar = $form['avatar']->getData();

        if ($avatar) {
            $avatarName = $this->avatarUploader->upload($avatar);
            $currentUser = $this->userService->currentUser();
            /**@var User $currentUser */
            $currentUser->setAvatar($avatarName);
            $this->userService->merge($currentUser);
        }

        return $this->redirectToRoute('user_profile');
    }

    /**
     * @param $id
     *
     * @Route("user/{id}/comments", name="my-comments")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return Response
     */
    public function myComments($id)
    {
        $myComments = $this->commentService->findAllByUser($id);

        return $this->render('user/my-comments.html.twig', ['comments' => $myComments]);
    }
}
