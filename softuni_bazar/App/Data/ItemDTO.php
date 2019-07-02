<?php

namespace App\Data;


class ItemDTO
{
    private CONST TITLE_MIN_LENGTH=3;
    private CONST TITLE_MAX_LENGTH=255;

    private CONST PRICE_MIN_LENGTH=1;
    private CONST PRICE_MAX_LENGTH=50;

    private CONST DESCRIPTION_MIN_LENGTH=10;
    private CONST DESCRIPTION_MAX_LENGTH=10000;

    private CONST IMAGE_MIN_LENGTH=10;
    private CONST IMAGE_MAX_LENGTH=10000;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $imageURL;

    /**
     * @var CategoryDTO
     */
    private $category;

    /**
     * @var UserDTO
     */
    private $user;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @throws \Exception
     */
    public function setTitle(string $title): void
    {
        DtoValidator::validate(
            self::TITLE_MIN_LENGTH,
            self::TITLE_MAX_LENGTH,
            $title,
            'text',
            'Title');
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @throws \Exception
     */
    public function setPrice(string $price): void
    {
        DtoValidator::validate(
            self::PRICE_MIN_LENGTH,
            self::PRICE_MAX_LENGTH,
            $price,
            'text',
            'Price');
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @throws \Exception
     */
    public function setDescription(string $description): void
    {
        DtoValidator::validate(
            self::DESCRIPTION_MIN_LENGTH,
            self::DESCRIPTION_MAX_LENGTH,
            $description,
            'text',
            'Description');
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImageURL(): string
    {
        return $this->imageURL;
    }

    /**
     * @param string $imageURL
     * @throws \Exception
     */
    public function setImageURL(string $imageURL): void
    {
        DtoValidator::validate(
            self::IMAGE_MIN_LENGTH,
            self::IMAGE_MAX_LENGTH,
            $imageURL,
            'text',
            'Image URL');
        $this->imageURL = $imageURL;
    }

    /**
     * @return CategoryDTO
     */
    public function getCategory(): CategoryDTO
    {
        return $this->category;
    }

    /**
     * @param CategoryDTO $category
     */
    public function setCategory(CategoryDTO $category): void
    {
        $this->category = $category;
    }

    /**
     * @return UserDTO
     */
    public function getUser(): UserDTO
    {
        return $this->user;
    }

    /**
     * @param UserDTO $user
     */
    public function setUser(UserDTO $user): void
    {
        $this->user = $user;
    }



}