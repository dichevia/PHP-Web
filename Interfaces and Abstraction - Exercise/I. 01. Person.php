<?php

interface Person
{
    public function setName($name): void;

    public function setAge($age): void;
}

class Citizen implements Person
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $age;

    /**
     * Citizen constructor.
     * @param string $name
     * @param int $age
     */
    public function __construct(string $name, int $age)
    {
        $this->setName($name);
        $this->setAge($age);
    }


    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setAge($age): void
    {
        $this->age = $age;
    }

    public function __toString()
    {
        return $this->name.PHP_EOL.$this->age.PHP_EOL;
    }
}

$name = readline();
$age = intval(readline());

$person = new Citizen($name, $age);

echo $person;