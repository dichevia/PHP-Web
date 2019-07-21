<?php


namespace TopCarBundle\Service\Users;


use Symfony\Component\Security\Core\Security;
use TopCarBundle\Entity\User;
use TopCarBundle\Repository\Users\UserRepository;
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
        return $this->userRepository->findOneBy(['email' => $email]);
    }

    public function save(User $user)
    {
        $passwordHash = $this->encryptionService->hash($user->getPassword());
        $user->setPassword($passwordHash);

        return $this->userRepository->insert($user);
    }

    public function findOneById($id)
    {
        $this->userRepository->find($id);
    }

    public function findOne($user)
    {
        return $this->userRepository->find($user);
    }

    public function currentUser()
    {
        return $this->security->getUser();
    }
}