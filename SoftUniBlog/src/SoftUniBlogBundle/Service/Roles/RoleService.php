<?php


namespace SoftUniBlogBundle\Service\Roles;


use SoftUniBlogBundle\Repository\RoleRepository;

class RoleService implements RoleServiceInterface
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function findOneBy($criteria)
    {
        return $this->roleRepository->findOneBy(['name' => $criteria]);
    }
}