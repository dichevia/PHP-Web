<?php

class Person18
{
    private $name;
    private $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }


}

class Family
{
    private $members;

    public function addMember(Person18 $member)
    {
        $this->members[] = $member;
    }

    public function getOldestMember()
    {

        usort($this->members, function ($member1, $member2) {
            /**
             * @var Person18 $member1
             */
            /**
             * @var Person18 $member2
             */
            $age1 = $member1->getAge();
            $age2 = $member2->getAge();

            return $age2 <=> $age1;
        });

        return $this->members[0];
    }
}

$n = intval(readline());
$family = new Family();
for ($i = 0; $i < $n; $i++) {
    $input = readline();
    list ($name, $age) = explode(' ', $input);
    $member = new Person18($name, $age);
    $family->addMember($member);
}

$oldestMember = $family->getOldestMember();

/**
 * @var Person18 $oldestMember
 */

echo $oldestMember->getName() . ' ' . $oldestMember->getAge();
