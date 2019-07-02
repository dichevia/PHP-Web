<?php

namespace App\Repository\Items;


use App\Data\ItemDTO;

interface ItemRepositoryInterface
{
    public function insert(ItemDTO $itemDTO): bool;
    public function update(ItemDTO $itemDTO, int $id): bool;
    public function remove(int $id) : bool;

    /**
     * @return \Generator|ItemDTO[]
     */
    public function findAll(): \Generator;

    public function findOneById(int $id) : ItemDTO;

    /**
     * @param int $id
     * @return \Generator|ItemDTO[]
     */
    public function findAllByAuthorId(int $id) : \Generator;
}