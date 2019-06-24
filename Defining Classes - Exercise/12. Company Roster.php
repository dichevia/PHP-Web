<?php

class Employee
{
    private $name;
    private $salary;
    private $position;
    private $department;
    private $email;
    private $age;

    public function __construct(string $name, float $salary, string $position, string $department, string $email = null, int $age = null)
    {
        $this->name = $name;
        $this->salary = $salary;
        $this->position = $position;
        $this->department = $department;
        $this->email = $email;
        $this->age = $age;
    }

    public function setEmailIfDoestExist(): void
    {
        $this->email = "n/a";

    }

    public function setAgeIfDoestExist(): void
    {
        $this->age = -1;

    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function __toString()
    {
        return $this->getName() . ' ' . number_format($this->getSalary(), 2, '.', '') . ' ' . $this->getEmail() . ' ' . $this->getAge();
    }

}


$n = intval(readline());
$departments = [];
$SalaryByDepartment = [];

for ($i = 0; $i < $n; $i++) {
    $input = readline();
    $args = explode(' ', $input);
    $employee = new Employee($args[0], $args[1], $args[2], $args[3]);
    if (count($args) == 4) {
        $employee->setEmailIfDoestExist();
        $employee->setAgeIfDoestExist();
    } elseif (count($args) == 5) {
        if (strpos($args[4], '@')) {
            $employee->setEmail($args[4]);
            $employee->setAgeIfDoestExist();
        } else {
            $employee->setAge($args[4]);
            $employee->setEmailIfDoestExist();
        }

    } else {
        $employee = new Employee($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);
    }
    $departments[$args[3]][] = $employee;
    $SalaryByDepartment[$args[3]][] = $employee->getSalary();
}

$avgSalaryByDepartment = [];

foreach ($SalaryByDepartment as $department => $salaries) {
    $avgSalaryByDepartment[$department] = array_sum($salaries) / count($salaries);
}

arsort($avgSalaryByDepartment);

$highestDepartment = '';

foreach ($avgSalaryByDepartment as $depart => $maxAvgSalary) {
    echo "Highest Average Salary: $depart" . PHP_EOL;
    $highestDepartment = $depart;
    break;
}

$bestDepartment = $departments[$highestDepartment];

uasort($bestDepartment, function ($employee1, $employee2) use ($bestDepartment) {
    /**
     * @var Employee $employee1
     * @var Employee $employee2
     */
    $salary1 = $employee1->getSalary();
    $salary2 = $employee2->getSalary();

    return $salary2 <=> $salary1;
});

/**
 * @var Employee $employee
 */

foreach ($bestDepartment as $employee) {
    echo $employee . PHP_EOL;
}