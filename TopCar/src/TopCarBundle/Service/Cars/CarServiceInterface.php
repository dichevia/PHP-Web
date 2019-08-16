<?php


namespace TopCarBundle\Service\Cars;

use TopCarBundle\Entity\Car;

interface CarServiceInterface
{
    public function save(Car $car);

    public function edit(Car $car);

    public function remove(Car $car);

    public function updateViews(Car $car);

    public function findAllByDate();

    public function findOneById($id);

    public function findAllByOwnerId();

    public function findFirstMostViewed();

    public function findAllByBody($type);

    public function findAllByBrand($brand);
}