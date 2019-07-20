<?php


namespace TopCarBundle\Service\Users;


use Symfony\Component\Security\Core\Security;
use TopCarBundle\Entity\User;
use TopCarBundle\Repository\UserRepository;
use TopCarBundle\Service\Encryption\ArgonEncryption;

class UserService implements UserServiceInterface
{
    private $userRepository;

    private $security;

    private $encryptionService;

    public function __construct(UserRepository $userRepository,
                                Security $security,
                                ArgonEncryption $encryptionService)
    {
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->encryptionService = $encryptionService;
    }

    public function findOneByEmail($email)
    {
        // TODO: Implement findOneByEmail() method.
    }

    public function save(User $user)
    {
        $passwordHash = $this->encryptionService->hash($user->getPassword());
        $user->setPassword($passwordHash);

        return $this->userRepository->insert($user);
    }

    public function findOneById($id)
    {
        // TODO: Implement findOneById() method.
    }

    public function findOne($user)
    {
        // TODO: Implement findOne() method.
    }

    public function currentUser()
    {
        // TODO: Implement currentUser() method.
    }
}