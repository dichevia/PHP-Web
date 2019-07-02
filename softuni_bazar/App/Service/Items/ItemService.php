<?php

namespace App\Service\Items;


use App\Data\ItemDTO;
use App\Repository\Items\ItemRepositoryInterface;
use App\Service\Users\UserServiceInterface;

class ItemService implements ItemServiceInterface
{
    /**
     * @var ItemRepositoryInterface
     */
    private $itemRepository;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(ItemRepositoryInterface $itemRepository,
                                UserServiceInterface $userService)
    {
        $this->itemRepository = $itemRepository;
        $this->userService = $userService;
    }


    public function add(ItemDTO $itemDTO): bool
    {
        return $this->itemRepository->insert($itemDTO);
    }

    /**
     * @param ItemDTO $itemDTO
     * @param int $userId
     * @return bool
     * @throws \Exception
     */
    public function edit(ItemDTO $itemDTO, int $userId): bool
    {
        $items = $this->itemRepository->findAllByAuthorId($userId);
        $hasItem = false;
        foreach ($items as $userItem) {
            if ($userItem->getId() == $itemDTO->getId()) {
                $hasItem = true;
                break;
            }
        }

        if (!$hasItem) {
            throw new \Exception('Not an owner');
        }
        return $this->itemRepository->update($itemDTO, $itemDTO->getId());
    }

    public function delete(int $id): bool
    {
        return $this->itemRepository->remove($id);
    }

    /**
     * @return \Generator|ItemDTO[]
     */
    public function getAll(): \Generator
    {
        return $this->itemRepository->findAll();
    }

    public function getOneById(int $id): ItemDTO
    {
        return $this->itemRepository->findOneById($id);
    }

    public function getAllByAuthor()
    {
        $currentUser = $this->userService->currentUser();

        return $this->itemRepository->findAllByAuthorId($currentUser->getId());
    }
}