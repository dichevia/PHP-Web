<?php

interface Identifiable
{
    public function setId($id): void;
}

interface Birthable
{
    public function setBirthDay($birthday): void;

}


interface Person
{
    public function setName($name): void;

    public function setAge($age): void;
}

class Citizen implements Person, Identifiable, Birthable
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
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $birthday;

    /**
     * Citizen constructor.
     * @param string $name
     * @param int $age
     * @param string $id
     * @param string $birthday
     */
    public function __construct(string $name, int $age, string $id, string $birthday)
    {
        $this->setName($name);
        $this->setAge($age);
        $this->setId($id);
        $this->setBirthDay($birthday);
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
        return $this->name . PHP_EOL . $this->age . PHP_EOL.$this->id.PHP_EOL.$this->birthday;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setBirthDay($birthday): void
    {
        $this->birthday = $birthday;
    }
}

$name = readline();
$age = intval(readline());
$id = readline();
$birthday = readline();


$person = new Citizen($name, $age, $id, $birthday);

echo $person;