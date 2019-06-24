<?php


interface checkIdInterface06
{
    public function checkId(string $lastDigits): bool;
}

interface addBirthDayInterface
{
    public function addBirthday(string $birthday): void;

    public function checkYear(string $year): bool;
}

abstract class Citizen06 implements addBirthDayInterface
{

    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $birthday;


    /**
     * Citizen06 constructor.
     * @param string $name
     * @param string $birthday
     */

    public function __construct(string $name, string $birthday)
    {
        $this->setName($name);
        $this->addBirthday($birthday);

    }

    /**
     * @param string $name
     */

    protected function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $birthday
     */
    public function addBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }


}

class Human06 extends Citizen06 implements checkIdInterface06, addBirthDayInterface
{
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


    /**
     * Human06 constructor.
     * @param string $name
     * @param int $age
     * @param string $id
     * @param string $birthday
     */

    public function __construct(string $name, int $age, string $id, $birthday)
    {
        parent::__construct($name, $birthday);
        $this->setAge($age);
        $this->setId($id);

    }

    /**
     * @param int $age
     */

    private function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * @param string $id
     */
    protected function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->birthday . PHP_EOL;
    }

    /**
     * @param string $lastDigits
     * @return bool
     */
    public function checkId(string $lastDigits): bool
    {
        $lastDigitsFromMainString = substr($this->id, strlen($this->id) - strlen($lastDigits));
        $result = substr_compare($lastDigitsFromMainString, $lastDigits, 0);
        if ($result === 0) {
            return true;
        }

        return false;
    }


    /**
     * @param string $birthday
     */
    public function addBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function checkYear(string $year): bool
    {
        $birthdayYear = substr($this->birthday, strlen($this->birthday) - strlen($year));
        $result = substr_compare($birthdayYear, $year, 0);
        if ($result === 0) {
            return true;
        }

        return false;
    }
}

class Robot06 extends Citizen06 implements checkIdInterface06
{

    const ROBOT_AGE = 0;
    /**
     * @var string
     */

    private $id;

    /**
     * Robot06 constructor.
     * @param string $name
     * @param string $id
     * @param $birthday
     */

    public function __construct(string $name, string $id, string $birthday)
    {
        parent::__construct($name, $birthday);
        $this->setId($id);
        $this->addBirthday($birthday);
    }

    /**
     * @param string $id
     */
    protected function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->birthday . PHP_EOL;
    }

    /**
     * @param string $lastDigits
     * @return bool
     */
    public function checkId(string $lastDigits): bool
    {
        $lastDigitsFromMainString = substr($this->id, strlen($this->id) - strlen($lastDigits));
        $result = substr_compare($lastDigitsFromMainString, $lastDigits, 0);
        if ($result === 0) {
            return true;
        }

        return false;
    }

    public function addBirthday(string $birthday): void
    {
        parent::addBirthday(self::ROBOT_AGE);
    }

    public function checkYear(string $year): bool
    {
        $birthdayYear = substr($this->birthday, strlen($this->birthday) - strlen($year));
        $result = substr_compare($birthdayYear, $year, 0);
        if ($result === 0) {
            return true;
        }

        return false;
    }
}

class Pet extends Citizen06 implements addBirthDayInterface
{


    /**
     * Pet constructor.
     * @param string $name
     * @param $birthday
     */
    public function __construct(string $name, $birthday)
    {
        parent::__construct($name, $birthday);
    }

    /**
     * @param string $birthday
     */

    public function addBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function checkYear(string $year): bool
    {
        $birthdayYear = substr($this->birthday, strlen($this->birthday) - strlen($year));
        $result = substr_compare($birthdayYear, $year, 0);
        if ($result === 0) {
            return true;
        }

        return false;
    }

    public function __toString()
    {
        return $this->birthday . PHP_EOL;
    }
}

$identifications = [];

while (true) {
    $input = readline();

    if ($input === 'End') {
        break;
    }

    $data = explode(' ', $input);
    if (count($data) === 5) {
        $name = $data[1];
        $age = intval($data[2]);
        $id = $data[3];
        $birthday = $data[4];
        $human = new Human06($name, $age, $id, $birthday);
        $identifications [] = $human;
    } elseif (count($data) === 3) {
        if (strpos($data[2], '/') === false) {
            $name = $data[1];
            $id = $data[2];
            $robot = new Robot06 ($name, $id, 0);
            $identifications [] = $robot;
        } else {
            $name = $data[1];
            $birthday = $data[2];
            $pet = new Pet($name, $birthday);
            $identifications [] = $pet;
        }
    }
}

$param = readline();

$output = false;

foreach ($identifications as $object) {
    if ($object->checkYear($param)) {
        echo $object;
        $output=true;
    }
}
if ($output===false){
    echo '<no ' . 'output>';
}