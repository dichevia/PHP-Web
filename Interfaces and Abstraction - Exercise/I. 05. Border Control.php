<?php

interface checkIdInterface
{
    public function checkId(string $lastDigits): bool;
}

abstract class Citizen05 implements checkIdInterface
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */

    private $id;

    /**
     * Human constructor.
     * @param string $name
     * @param string $id
     */

    public function __construct(string $name, string $id)
    {
        $this->setName($name);

        $this->setId($id);
    }

    /**
     * @param string $name
     */

    protected function setName(string $name): void
    {
        $this->name = $name;
    }


    /**
     * @param string $id
     */
    protected function setId(string $id): void
    {
        $this->id = $id;
    }

    public function checkId(string $lastDigits): bool
    {
        $lastDigitsFromMainString = substr($this->id, strlen($this->id) - strlen($lastDigits));
        $result = substr_compare($lastDigitsFromMainString, $lastDigits, 0);
        if ($result === 0) {
            return true;
        }

        return false;
    }

    public function __toString()
    {
        return $this->id . PHP_EOL;
    }

}

class Human extends Citizen05 implements checkIdInterface
{
    /**
     * @var int
     */
    private $age;


    public function __construct(string $name, int $age, string $id)
    {
        parent::__construct($name, $id);
        $this->setAge($age);

    }

    private function setAge(int $age): void
    {
        $this->age = $age;
    }


}

class Robot extends Citizen05 implements checkIdInterface
{

    public function __construct(string $name, string $id)
    {
        parent::__construct($name, $id);
    }


}

$identifications = [];

while (true) {
    $input = readline();

    if ($input === 'End') {
        break;
    }

    $data = explode(' ', $input);
    if (count($data) === 3) {
        $name = $data[0];
        $age = intval($data[1]);
        $id = $data[2];
        $human = new Human($name, $age, $id);
        $identifications [] = $human;
    }
    if (count($data) === 2) {
        $name = $data[0];
        $id = $data[1];
        $robot = new Robot($name, $id);
        $identifications [] = $robot;
    }
}

$param = readline();

foreach ($identifications as $object) {
    if ($object->checkId($param)) {
        echo $object;
    }
}