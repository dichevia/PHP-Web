<?php

class Person
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var  integer
     */
    private $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

}

$n = intval(readline());
$people = [];
for ($i = 0; $i < $n; $i++) {
    $input = readline();
    list($name, $age) = explode(' ', $input);
    $person = new Person($name, $age);
    if ($person->getAge() > 30) {
        $people[] = $person;
    }

}

usort($people, function ($person1, $person2) use ($people) {
    /**
     * @var Person $person1
     * @var Person $person2
     */

    return $person1->getName() <=> $person2->getName();
});

foreach ($people as $person) {
    /**
     * @var Person $person
     */

    echo $person->getName() . ' - ' . $person->getAge() . PHP_EOL;
}