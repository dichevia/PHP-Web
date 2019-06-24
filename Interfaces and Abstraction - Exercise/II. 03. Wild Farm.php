<?php

abstract class Food03
{
    /**
     * @var integer
     */
    protected $quantity;

    /**
     * Food constructor.
     * @param int $quantity
     */
    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

}

class Meat extends Food03
{
    /**
     * Meat constructor.
     * @param int $quantity
     */
    public function __construct(int $quantity)
    {
        parent::__construct($quantity);
    }

}

class Vegetable extends Food03
{
    /**
     * Vegetable constructor.
     * @param int $quantity
     */
    public function __construct(int $quantity)
    {
        parent::__construct($quantity);
    }

}

interface animalInterface
{
    public function makeSound(): void;

    public function eat(string $foot, int $quantity): void;

}

abstract class Animal implements animalInterface
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var float
     */
    protected $weight;
    /**
     * @var integer
     */
    protected $foodEaten;

    /**
     * Animal constructor.
     * @param string $name
     * @param string $type
     * @param float $weight
     */
    public function __construct(string $name, string $type, float $weight)
    {
        $this->name = $name;
        $this->type = $type;
        $this->weight = $weight;
        $this->foodEaten = 0;
    }

}

abstract class Mammal extends Animal
{
    /**
     * @var string
     */
    protected $livingRegion;

    /**
     * Mammal constructor.
     * @param string $name
     * @param string $type
     * @param float $weight
     * @param string $livingRegion
     */
    public function __construct(string $name, string $type, float $weight, string $livingRegion)
    {
        parent::__construct($name, $type, $weight);
        $this->livingRegion = $livingRegion;
    }

}

abstract class Felime extends Mammal
{
    /**
     * Felime constructor.
     * @param string $name
     * @param string $type
     * @param float $weight
     * @param string $livingRegion
     */
    public function __construct(string $name, string $type, float $weight, string $livingRegion)
    {
        parent::__construct($name, $type, $weight, $livingRegion);
    }

}

class Tiger extends Felime
{
    /**
     * Tiger constructor.
     * @param string $name
     * @param string $type
     * @param float $weight
     * @param string $livingRegion
     */
    public function __construct(string $name, string $type, float $weight, string $livingRegion)
    {
        parent::__construct($name, $type, $weight, $livingRegion);
    }

    public function makeSound(): void
    {
        echo 'ROAAR!!!' . PHP_EOL;
    }

    public function eat(string $foot, int $quantity): void
    {
        if ($foot === 'Meat') {
            $this->foodEaten += $quantity;
        } else {
            echo get_class($this) . 's are not eating that type of food!' . PHP_EOL;
        }
    }

    public function __toString()
    {
        return get_class($this) . '[' . $this->name . ', ' . floatval($this->weight) .
            ', ' . $this->livingRegion . ', ' . $this->foodEaten . ']' . PHP_EOL;
    }

}

class Cat extends Felime
{
    /**
     * @var string
     */
    private $breed;

    /**
     * Cat constructor.
     * @param string $name
     * @param string $type
     * @param float $weight
     * @param string $breed
     * @param string $livingRegion
     */
    public function __construct(string $name, string $type, float $weight, string $breed, string $livingRegion)
    {
        parent::__construct($name, $type, $weight, $livingRegion);
        $this->breed = $breed;

    }

    public function makeSound(): void
    {
        echo 'Meowwww' . PHP_EOL;
    }

    public function eat(string $foot, int $quantity): void
    {
        $this->foodEaten += $quantity;
    }

    public function __toString()
    {
        return get_class($this) . '[' . $this->name . ', ' . $this->breed . ', ' . floatval($this->weight) .
            ', ' . $this->livingRegion . ', ' . $this->foodEaten . ']' . PHP_EOL;
    }

}

class Mouse extends Mammal
{
    /**
     * Mouse constructor.
     * @param string $name
     * @param string $type
     * @param float $weight
     * @param string $livingRegion
     */
    public function __construct(string $name, string $type, float $weight, string $livingRegion)
    {
        parent::__construct($name, $type, $weight, $livingRegion);
    }

    public function makeSound(): void
    {
        echo 'SQUEEEAAAK!' . PHP_EOL;
    }

    public function eat(string $foot, int $quantity): void
    {
        if ($foot === 'Vegetable') {
            $this->foodEaten += $quantity;
        } else {
            echo get_class($this) . 's are not eating that type of food!' . PHP_EOL;
        }
    }

    public function __toString()
    {
        return get_class($this) . '[' . $this->name . ', ' . floatval($this->weight) .
            ', ' . $this->livingRegion . ', ' . $this->foodEaten . ']' . PHP_EOL;
    }

}

class Zebra extends Mammal
{
    /**
     * Zebra constructor.
     * @param string $name
     * @param string $type
     * @param float $weight
     * @param string $livingRegion
     */
    public function __construct(string $name, string $type, float $weight, string $livingRegion)
    {
        parent::__construct($name, $type, $weight, $livingRegion);
    }

    public function makeSound(): void
    {
        echo 'Zs' . PHP_EOL;
    }

    public function eat(string $foot, int $quantity): void
    {
        if ($foot === 'Vegetable') {
            $this->foodEaten += $quantity;
        } else {
            echo get_class($this) . 's are not eating that type of food!' . PHP_EOL;
        }
    }

    public function __toString()
    {
        return get_class($this) . '[' . $this->name . ', ' . floatval($this->weight) .
            ', ' . $this->livingRegion . ', ' . $this->foodEaten . ']' . PHP_EOL;
    }

}

while (true) {
    $animalInput = readline();
    if ($animalInput === 'End') {
        break;
    }
    $foodInput = readline();

    $animalData = explode(' ', $animalInput);
    $type = $animalData[0];
    $name = $animalData[1];
    $weight = $animalData[2];
    $livingRegion = $animalData[3];

    if (count($animalData) === 5) {
        $breed = $animalData[4];
    }

    $foodData = explode(' ', $foodInput);
    $foodType = $foodData[0];
    $foodQuantity = $foodData[1];

    switch ($type) {
        case 'Cat':
            $animal = new Cat($name, $type, $weight, $breed, $livingRegion);
            break;
        case 'Tiger':
            $animal = new Tiger($name, $type, $weight, $livingRegion);
            break;
        case 'Mouse':
            $animal = new Mouse($name, $type, $weight, $livingRegion);
            break;
        case 'Zebra':
            $animal = new Zebra($name, $type, $weight, $livingRegion);
            break;
    }

    $animal->makeSound();
    $animal->eat($foodType, $foodQuantity);
    echo $animal;

}