<?php

namespace App\Repository\Categories;


use App\Data\CategoryDTO;

interface CategoryRepositoryInterface
{
    /**
     * @return \Generator|CategoryDTO[]
     */
    public function findAll() : \Generator;

    public function findOneById(int $id): CategoryDTO;
}