<?php

namespace App\Service\Categories;


use App\Data\CategoryDTO;
use App\Repository\Categories\CategoryRepositoryInterface;


class CategoryService implements CategoryServiceInterface
{
    /**
     * @var \App\Repository\Categories\CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Generator|CategoryDTO[]
     */
    public function getAll(): \Generator
    {
        return $this->categoryRepository->findAll();
    }

    public function getOneById(int $id): CategoryDTO
    {
        return $this->categoryRepository->findOneById($id);
    }
}