<?php


namespace SoftUniBlogBundle\Service\Users;


use SoftUniBlogBundle\Entity\User;

interface UserServiceInterface
{
    public function findOneByEmail($email);

    public function save(User $user);

    public function findOneById ($id);

    public function findOne ($user);

    public function currentUser();
}