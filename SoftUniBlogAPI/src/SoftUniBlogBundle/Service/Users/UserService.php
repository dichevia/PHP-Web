<?php


namespace SoftUniBlogBundle\Service\Users;


use SoftUniBlogBundle\Entity\User;
use SoftUniBlogBundle\Repository\UserRepository;
use SoftUniBlogBundle\Service\Encryption\ArgonEncryption;
use SoftUniBlogBundle\Service\Roles\RoleServiceInterface;
use Symfony\Component\Security\Core\Security;

class UserService implements UserServiceInterface
{
    private $userRepository;

    private $security;

    private $encryptionService;

    private $roleService;

    public function __construct(UserRepository $userRepository,
                                Security $security,
                                ArgonEncryption $encryptionService,
                                RoleServiceInterface $roleService)
    {
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->encryptionService = $encryptionService;
        $this->roleService = $roleService;
    }

    public function findOneByEmail($email)
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user)
    {
        $passwordHash = $this->encryptionService->hash($user->getPassword());
        $user->setPassword($passwordHash);

        $userRole = $this->roleService->findOneBy("ROLE_USER");
        $user->addRole($userRole);

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