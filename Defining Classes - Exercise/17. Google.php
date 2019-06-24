<?php

class Company
{
    private $name;
    private $department;
    private $salary;

    public function __construct(string $name, string $department, float $salary)
    {
        $this->name = $name;
        $this->department = $department;
        $this->salary = $salary;
    }

    public function __toString()
    {
        $salaryFormat = number_format($this->salary, 2, '.', '');

        return $this->name . ' ' . $this->department . ' ' . $salaryFormat . PHP_EOL;
    }


}

class Pokemon17
{
    private $name;
    private $type;

    public function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function __toString()
    {
        return $this->name . ' ' . $this->type . PHP_EOL;
    }

}

class Parents
{
    private $name;
    private $birthday;

    public function __construct(string $name, string $birthday)
    {
        $this->name = $name;
        $this->birthday = $birthday;
    }

    public function __toString()
    {
        return $this->name . ' ' . $this->birthday . PHP_EOL;
    }
}

class Children
{
    private $name;
    private $birthday;

    public function __construct(string $name, string $birthday)
    {
        $this->name = $name;
        $this->birthday = $birthday;
    }

    public function __toString()
    {
        return $this->name . ' ' . $this->birthday . PHP_EOL;
    }
}

class CarGoogle
{
    private $model;
    private $speed;

    public function __construct(string $model, int $speed)
    {
        $this->model = $model;
        $this->speed = $speed;
    }

    public function __toString()
    {
        return $this->model . ' ' . $this->speed . PHP_EOL;
    }
}

class PersonGoogle
{
    private $company;
    private $pokemons;
    private $parents;
    private $children;
    private $car;

    public function __construct(Company $company = null, Pokemon17 $pokemon = null, Parents $parents = null, Children $children = null, CarGoogle $car = null)
    {
        $this->company = $company;
        $this->pokemons[] = $pokemon;
        $this->parents[] = $parents;
        $this->children[] = $children;
        $this->car = $car;
    }


    public function setPokemon(Pokemon17 $pokemon): void
    {
        $this->pokemons[] = $pokemon;
    }


    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }


    public function setParents(Parents $parents): void
    {
        $this->parents[] = $parents;
    }


    public function setChildren(Children $children): void
    {
        $this->children[] = $children;
    }


    public function setCar(CarGoogle $car): void
    {
        $this->car = $car;
    }


    public function __toString()
    {
        $output = [];
        $output[] = "Company:" . PHP_EOL;
        if ($this->company !== null) {
            $output[] = $this->company->__toString();
        }
        $output[] = "Car:" . PHP_EOL;
        if ($this->car !== null) {
            $output[] = $this->car->__toString();
        }

        $output[] = "Pokemon:" . PHP_EOL;
        $output[] = implode('', $this->pokemons);

        $output[] = "Parents:" . PHP_EOL;
        $output[] = implode('', $this->parents);

        $output[] = "Children:" . PHP_EOL;
        $output[] = implode('', $this->children);

        return implode('', $output);
    }

}

$people = [];
while (true) {
    $input = readline();
    if ($input === 'End') {
        break;
    }
    $args = explode(' ', $input);
    $name = $args[0];
    $command = $args[1];
    if ($command == 'company') {
        $companyName = $args[2];
        $companyDepartment = $args[3];
        $companySalary = floatval($args[4]);
        $companyObject = new Company($companyName, $companyDepartment, $companySalary);
    }
    if ($command == 'Pokemon17') {
        $pokemonName = $args[2];
        $pokemonType = $args[3];
        $pokemonObject = new Pokemon17($pokemonName, $pokemonType);
    }
    if ($command == 'parents') {
        $parentsName = $args[2];
        $parentsBirthday = $args[3];
        $parentsObject = new Parents($parentsName, $parentsBirthday);
    }
    if ($command == 'children') {
        $childrenName = $args[2];
        $childrenBirthday = $args[3];
        $childrenObject = new Children($childrenName, $childrenBirthday);
    }
    if ($command == 'CarTest') {
        $carModel = $args[2];
        $carSpeed = $args[3];
        $carObject = new CarGoogle($carModel, $carSpeed);
    }
    if (!key_exists($name, $people)) {
        switch ($command) {
            case 'company':
                $person = new PersonGoogle($companyObject);
                break;
            case 'Pokemon17':
                $person = new PersonGoogle(null, $pokemonObject);
                break;
            case 'parents':
                $person = new PersonGoogle(null, null, $parentsObject);
                break;
            case 'children':
                $person = new PersonGoogle(null, null, null, $childrenObject);
                break;
            case 'CarTest':
                $person = new PersonGoogle(null, null, null, null, $carObject);
                break;
        }
        $people[$name] = $person;
    } else {

        switch ($command) {
            case 'company':
                $people[$name]->setCompany($companyObject);
                break;
            case 'Pokemon17':

                $people[$name]->setPokemon($pokemonObject);
                break;
            case 'parents':
                $people[$name]->setParents($parentsObject);
                break;
            case 'children':
                $people[$name]->setChildren($childrenObject);
                break;
            case 'CarTest':
                $people[$name]->setCar($carObject);
                break;
        }
    }
}

$commandName = readline();

foreach ($people as $name => $objects) {
    if ($name == $commandName) {
        echo $name . PHP_EOL;
        echo $objects;
    }
}