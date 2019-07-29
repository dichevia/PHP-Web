<?php


namespace TopCarBundle\Service\Cars;

use TopCarBundle\Entity\Car;

interface CarServiceInterface
{
    public function save(Car $car): bool;

    public function edit(Car $car): bool;

    public function remove(Car $car): bool;

    public function findAllByDate();

    public function findOneById(int $id);

    public function findAllByOwnerId();

    public function findFirstMostViewed();

    public function findAllByBody($type);

    public function findAllByBrand($brand);
}