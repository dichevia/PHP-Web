<?php

namespace App\Service\Categories;


use App\Data\CategoryDTO;

interface CategoryServiceInterface
{
    /**
     * @return \Generator|CategoryDTO[]
     */
    public function getAll(): \Generator;

    public function getOneById(int $id) : CategoryDTO;
}