<?php


namespace TopCarBundle\Service\Cars;

use TopCarBundle\Entity\Car;

interface CarServiceInterface
{
    public function save(Car $car): bool;

    public function update(Car $car, int $id): bool;

    public function remove(Car $car): bool;

    public function findAll();

    public function findOneById(int $id);

    public function findAllByOwnerId();

    public function findFirstMostViewed();
}