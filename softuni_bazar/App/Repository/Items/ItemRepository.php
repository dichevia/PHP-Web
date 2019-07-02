<?php

namespace App\Repository\Items;


use App\Data\ItemDTO;
use App\Data\CategoryDTO;
use App\Data\UserDTO;
use App\Repository\DatabaseAbstract;

class ItemRepository extends DatabaseAbstract implements ItemRepositoryInterface
{

    public function insert(ItemDTO $itemDTO): bool
    {
        $this->db->query(
            "
                 INSERT INTO items(
                      title, 
                      price, 
                      description, 
                      image_url, 
                      category_id, 
                      user_id)
                  VALUES (?,?,?,?,?,?)
            ")->execute([
            $itemDTO->getTitle(),
            $itemDTO->getPrice(),
            $itemDTO->getDescription(),
            $itemDTO->getImageURL(),
            $itemDTO->getCategory()->getId(),
            $itemDTO->getUser()->getId()
        ]);

        return true;
    }

    public function update(ItemDTO $itemDTO, int $id): bool
    {
        $this->db->query(
            "
                 UPDATE items
                 SET
                      title = ?, 
                      price = ?, 
                      description = ?, 
                      image_url = ?, 
                      category_id = ?, 
                      user_id = ?
                 WHERE id = ?
            ")->execute([
            $itemDTO->getTitle(),
            $itemDTO->getPrice(),
            $itemDTO->getDescription(),
            $itemDTO->getImageURL(),
            $itemDTO->getCategory()->getId(),
            $itemDTO->getUser()->getId(),
            $id
        ]);

        return true;
    }

    public function remove(int $id): bool
    {
        $this->db->
        query("DELETE FROM items WHERE id = ?")
            ->execute([$id]);
        return true;
    }

    /**
     * @return \Generator|ItemDTO[]
     */
    public function findAll(): \Generator
    {
        $lazyBookResult = $this->db->query(
            "
                  SELECT 
                      i.id as itemId,
                      i.title,
                      i.price,
                      i.description,
                      i.image_url as imageURL,
                      i.category_id,
                      i.user_id,
                      c.id as categoryId,
                      c.name,
                      u.id as userId,
                      u.username,
                      u.password,
                      u.full_name,
                      u.location,
                      u.phone
                  FROM items as i
                  INNER JOIN categories as c on i.category_id = c.id
                  INNER JOIN users as u on i.user_id = u.id
                  ORDER BY location DESC ,categoryId ASC ,price ASC 
            ")->execute()
            ->fetchAssoc();

        foreach ($lazyBookResult as $row) {

            /** @var ItemDTO $item */
            /** @var UserDTO $user */
            /** @var CategoryDTO $category */
            $item = $this->dataBinder->bind($row, ItemDTO::class);
            $category = $this->dataBinder->bind($row, CategoryDTO::class);
            $user = $this->dataBinder->bind($row, UserDTO::class);
            $item->setId($row['itemId']);
            $category->setId($row['categoryId']);
            $user->setId($row['userId']);
            $item->setCategory($category);
            $item->setUser($user);

            yield $item;
        }
    }

    public function findOneById(int $id): ItemDTO
    {
        $row = $this->db->query(
            "SELECT
                  i.id as itemId,
                      i.title,
                      i.price,
                      i.description,
                      i.image_url as imageURL,
                      i.category_id,
                      i.user_id,
                      c.id as categoryId,
                      c.name,
                      u.id as userId,
                      u.username,
                      u.password,
                      u.full_name,
                      u.location,
                      u.phone
                  FROM items as i
                  INNER JOIN categories as c on i.category_id = c.id
                  INNER JOIN users as u on i.user_id = u.id
                  WHERE i.id = ?
            ")->execute([$id])
                ->fetchAssoc()
            ->current();

        /** @var ItemDTO $item */
        /** @var UserDTO $user */
        /** @var CategoryDTO $category */
        $item = $this->dataBinder->bind($row, ItemDTO::class);
        $category = $this->dataBinder->bind($row, CategoryDTO::class);
        $user = $this->dataBinder->bind($row, UserDTO::class);
        $item->setId($row['itemId']);
        $category->setId($row['categoryId']);
        $user->setId($row['userId']);
        $item->setCategory($category);
        $item->setUser($user);

        return $item;
    }

    /**
     * @param int $id
     * @return \Generator|ItemDTO[]
     */
    public function findAllByAuthorId(int $id): \Generator
    {
        $lazyBookResult = $this->db->query(
            "
                  SELECT
                  i.id as itemId,
                      i.title,
                      i.price,
                      i.description,
                      i.image_url as imageURL,
                      i.category_id,
                      i.user_id,
                      c.id as categoryId,
                      c.name,
                      u.id as userId,
                      u.username,
                      u.password,
                      u.full_name
                  FROM items as i
                  INNER JOIN categories as c on i.category_id = c.id
                  INNER JOIN users as u on i.user_id = u.id
                  WHERE i.user_id = ?
                  ORDER BY  categoryId DESC, price DESC 
            ")->execute([$id])
            ->fetchAssoc();

        foreach ($lazyBookResult as $row) {

            /** @var ItemDTO $item */
            /** @var UserDTO $user */
            /** @var CategoryDTO $category */
            $item = $this->dataBinder->bind($row, ItemDTO::class);
            $category = $this->dataBinder->bind($row, CategoryDTO::class);
            $user = $this->dataBinder->bind($row, UserDTO::class);
            $item->setId($row['itemId']);
            $category->setId($row['categoryId']);
            $user->setId($row['userId']);
            $item->setCategory($category);
            $item->setUser($user);

            yield $item;
        }

    }
}