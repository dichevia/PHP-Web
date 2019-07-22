<?php


namespace TopCarBundle\Service\Cars;


use TopCarBundle\Entity\Car;
use TopCarBundle\Repository\Cars\CarRepository;
use TopCarBundle\Service\Users\UserServiceInterface;

class CarService implements CarServiceInterface
{
    private $carRepository;

    private $userService;

    public function __construct(CarRepository $carRepository, UserServiceInterface $userService)
    {
        $this->carRepository = $carRepository;
        $this->userService = $userService;
    }

    public function save(Car $car): bool
    {
        return $this->carRepository->insert($car);
    }

    public function update(Car $car, int $id): bool
    {
        // TODO: Implement update() method.
    }

    public function remove(int $id): bool
    {
        // TODO: Implement remove() method.
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
    }


    public function findOneById(int $id)
    {
        return $this->carRepository->find($id);
    }

    public function findAllByOwnerId(int $id)
    {
        // TODO: Implement findAllByOwnerId() method.
    }

    public function findFirstMostViewed()
    {
        return $this->carRepository->getFirstMostViewed();
    }
}