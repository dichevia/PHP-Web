<?php

namespace App\Repository\Categories;


use App\Data\CategoryDTO;
use App\Repository\DatabaseAbstract;

class CategoryRepository extends DatabaseAbstract implements CategoryRepositoryInterface
{

    /**
     * @return \Generator|CategoryDTO[]
     */
    public function findAll(): \Generator
    {
       return $this->db->query(
            "
                SELECT 
                    id,
                    name
                FROM categories
            ")->execute()
                ->fetch(CategoryDTO::class);
    }

    public function findOneById(int $id): CategoryDTO
    {
        return $this->db->query(
            "
                SELECT 
                    id,
                    name
                FROM categories
                WHERE id = ?
            ")->execute([$id])
            ->fetch(CategoryDTO::class)
            ->current();
    }
}