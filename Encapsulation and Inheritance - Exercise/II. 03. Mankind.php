<?php

class HumanManKind
{
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;

    /**
     * Human constructor.
     * @param $firstName
     * @param $lastName
     * @throws Exception
     */

    public function __construct($firstName, $lastName)
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
    }


    /**
     * @param $firstName
     * @throws Exception
     */
    protected function setFirstName($firstName): void
    {
        if (!ctype_upper($firstName[0])) {
            throw new Exception("Expected upper case letter!Argument: firstName");
        }
        if (strlen($firstName) < 4) {
            throw new Exception("Expected length at least 4 symbols!Argument: firstName");
        }
        $this->firstName = $firstName;

    }

    /**
     * @param $lastName
     * @throws Exception
     */
    protected function setLastName($lastName): void
    {
        if (!ctype_upper($lastName[0])) {
            throw new Exception("Expected upper case letter!Argument: lastName");
        }
        if (strlen($lastName) < 3) {
            throw new Exception("Expected length at least 3 symbols!Argument: lastName");
        }
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }


}

class StudentManKind extends HumanManKind
{
    /**
     * @var string;
     */
    private $facultyNumber;

    /**
     * Student constructor.
     * @param $firstName
     * @param $lastName
     * @param $facultyNumber
     * @throws Exception
     */
    public function __construct($firstName, $lastName, $facultyNumber)
    {
        parent::__construct($firstName, $lastName);
        $this->setFacultyNumber($facultyNumber);
    }

    /**
     * @param $facultyNumber
     * @throws Exception
     */
    private function setFacultyNumber($facultyNumber): void
    {

        if (strlen($facultyNumber) >= 5 && strlen($facultyNumber) <= 10) {
            $this->facultyNumber = $facultyNumber;
        } else {
            throw new Exception("Invalid faculty number!");
        }
    }

    public function __toString()
    {

        $firstName = parent::getFirstName();
        $lastName = parent::getLastName();

        return "First Name: $firstName\nLast Name: $lastName\nFaculty number: $this->facultyNumber\n";

    }
}

class WorkerManKind extends HumanManKind
{

    /**
     * @var float
     */
    private $salary;
    /**
     * @var float
     */
    private $workHours;

    /**
     * WorkerManKind constructor.
     * @param $firstName
     * @param $lastName
     * @param $salary
     * @param $workHours
     * @throws Exception
     */

    public function __construct($firstName, $lastName, $salary, $workHours)
    {

        parent::__construct($firstName, $lastName);
        $this->setSalary($salary);
        $this->setWorkHours($workHours);


    }

    protected function setLastName($lastName): void
    {
        if (strlen($lastName) <= 3) {
            throw new Exception("Expected length more than 3 symbols!Argument: lastName");
        }
        parent::setLastName($lastName);
    }


    /**
     * @param $salary
     * @throws Exception
     */
    private function setSalary(float $salary): void
    {
        if ($salary > 10) {
            $this->salary = $salary;
        } else {
            throw new Exception("Expected value mismatch!Argument: weekSalary");
        }
    }

    /**
     * @param $workHours
     * @throws Exception
     */
    private function setWorkHours($workHours): void
    {
        if ($workHours >= 1 && $workHours <= 12) {
            $this->workHours = $workHours;
        } else {
            throw new Exception("Expected value mismatch!Argument: workHoursPerDay");
        }
    }

    /**
     * @return float
     */
    public function calculateSalaryPerHour(): float
    {
        $weekSalary = $this->salary;
        $hoursPerDay = $this->workHours;
        $salaryPerHour = $weekSalary / (7 * $hoursPerDay);

        return $salaryPerHour;
    }

    public function __toString()
    {

        $firstName = parent::getFirstName();
        $lastName = parent::getLastName();
        $weekSalary = number_format($this->salary, 2, '.', '');
        $hoursPerDay = number_format($this->workHours, 2, '.', '');
        $salaryPerHour = number_format($this->calculateSalaryPerHour(), 2, '.', '');

        return "First Name: $firstName\nLast Name: $lastName\nWeek Salary: $weekSalary\nHours per day: $hoursPerDay\nSalary per hour: $salaryPerHour\n";

    }

}

$studentInput = explode(' ', (readline()));
$studentInput = array_filter($studentInput);
$studentInput = array_values($studentInput);


$fsName = $studentInput[0];
$lsName = $studentInput[1];
$fsNumber = $studentInput[2];


$workerInput = explode(' ', readline());
$workerInput = array_filter($workerInput);
$workerInput = array_values($workerInput);

$fName = $workerInput[0];
$lName = $workerInput[1];
$salary = $workerInput[2];
$workHours = $workerInput[3];

try {
    $student = new StudentManKind($fsName, $lsName, $fsNumber);
    $worker = new WorkerManKind($fName, $lName, $salary, $workHours);
    echo $student;
    echo PHP_EOL;
    echo $worker;
} catch (Exception $exception) {
    echo $exception->getMessage();
    return;
}