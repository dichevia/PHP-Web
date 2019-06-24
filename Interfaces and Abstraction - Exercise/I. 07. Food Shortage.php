<?php

interface buyFoodInterface
{
    public function buyFood(): int;
}

abstract class Person07
{

    const STARTING_FOOT = 0;

    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $age;
    /**
     * @var int
     */
    protected $food;

    /**
     * Citizen07 constructor.
     * @param string $name
     * @param int $age
     */
    public function __construct(string $name, int $age)
    {
        $this->setName($name);
        $this->setAge($age);
        $this->setFood();

    }


    /**
     * @param string $name
     */
    protected function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param int $age
     */
    protected function setAge(int $age): void
    {
        $this->age = $age;
    }


    protected function setFood(): void
    {
        $this->food = self::STARTING_FOOT;
    }

    /**
     * @return int
     */
    public function getFood(): int
    {
        return $this->food;
    }


}

class Citizen07 extends Person07 implements buyFoodInterface
{

    const FOOD_UNITS_CITIZEN = 10;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $birthday;

    public function __construct(string $name, int $age, string $id, string $birthday)
    {
        parent::__construct($name, $age);
        $this->setId($id);
        $this->setBirthday($birthday);

    }

    /**
     * @param string $id
     */
    private function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $birthday
     */
    private function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }


    public function buyFood(): int
    {
        $this->food += self::FOOD_UNITS_CITIZEN;

        return self::FOOD_UNITS_CITIZEN;
    }
}

class Rebel extends Person07 implements buyFoodInterface
{

    const FOOD_UNITS_REBEL = 5;


    /**
     * @var string
     */
    private $group;

    /**
     * Rebel constructor.
     * @param string $name
     * @param int $age
     * @param string $group
     */

    public function __construct(string $name, int $age, string $group)
    {
        parent::__construct($name, $age);
        $this->setGroup($group);
    }

    /**
     * @param string $group
     */
    private function setGroup(string $group): void
    {
        $this->group = $group;
    }

    public function buyFood(): int
    {
        $this->food += self::FOOD_UNITS_REBEL;

        return self::FOOD_UNITS_REBEL;
    }
}

$arrayPeople = [];
$n = intval(readline());

for ($i = 0; $i < $n; $i++) {
    $input = trim(readline());
    $tokens = explode(" ", $input);
    $name = $tokens[0];
    $age = intval($tokens[1]);
    if (count($tokens) == 4) {
        $id = $tokens[2];
        $birthDay = $tokens[3];
        $arrayPeople[$name] = new Citizen07 ($name, $age, $id, $birthDay);
    } else if (count($tokens) == 3) {
        $group = $tokens[2];
        $arrayPeople[$name] = new Rebel($name, $age, $group);
    }
}
$amountOfFood = [];
while (true) {
    $nameToBeChecked = trim(readline());
    if ($nameToBeChecked == "End") {
        break;
    }
    if (array_key_exists($nameToBeChecked, $arrayPeople)) {
        $person = $arrayPeople[$nameToBeChecked];
        $person->buyFood();
        $amountOfFood[$nameToBeChecked] = $person->getFood();
    }
}
echo array_sum($amountOfFood);