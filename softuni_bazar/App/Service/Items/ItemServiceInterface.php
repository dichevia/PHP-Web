<?php

namespace App\Service\Items;


use App\Data\ItemDTO;

interface ItemServiceInterface
{
    public function add(ItemDTO $itemDTO) : bool;
    public function edit(ItemDTO $itemDTO, int $userId) : bool;
    public function delete(int $id) : bool;

    /**
     * @return \Generator|ItemDTO[]
     */
    public function getAll() : \Generator;

    public function getOneById(int $id) : ItemDTO;

    public function getAllByAuthor();
}