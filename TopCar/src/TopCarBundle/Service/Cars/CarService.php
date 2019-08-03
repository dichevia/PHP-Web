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
        $owner = $this->userService->currentUser();
        $car->setOwner($owner);

        return $this->carRepository->insert($car);
    }

    public function edit(Car $car): bool
    {
        $car->setOwner($this->userService->currentUser());
        $car->setViewCount($car->getViewCount());

        return $this->carRepository->update($car);
    }

    public function remove(Car $car): bool
    {
        return $this->carRepository->remove($car);
    }

    public function findAllByDate()
    {
        return $this->carRepository->getAllByDate();
    }

    public function findOneById(int $id)
    {
        return $this->carRepository->find($id);
    }

    public function findAllByOwnerId()
    {
        return $this->carRepository->findBy(['owner' => $this->userService->currentUser()], ['dateAdded' => 'DESC']);
    }

    public function findFirstMostViewed()
    {
        return $this->carRepository->getFirstMostViewed();
    }


    public function findAllByBody($type)
    {
        return $this->carRepository->getAllByBody($type);
    }

    public function findAllByBrand($brand)
    {
        return $this->carRepository->getAllByBrand($brand);

    }
}