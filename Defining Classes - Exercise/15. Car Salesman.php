<?php

class CarSalesman
{
    private $model;
    private $engine;
    private $weight;
    private $color;

    public function __construct(string $model, EngineSalesman $engine, $weight = 'n/a', $color = 'n/a')
    {
        $this->model = $model;
        $this->engine = $engine;
        $this->weight = $weight;
        $this->color = $color;
    }


    public function __toString()
    {
        $output = $this->model . ':' . PHP_EOL . ' ' . $this->engine->getModel() . ':' . PHP_EOL . '   Power: ' . $this->engine->getPower() . PHP_EOL .
            '   Displacement: ' . $this->engine->getDisplacement() . PHP_EOL . '   Efficiency: ' . $this->engine->getEfficiency() . PHP_EOL .
            '  Weight: ' . $this->weight . PHP_EOL . '  Color: ' . $this->color.PHP_EOL;

        return $output;
    }
}

class EngineSalesman
{
    private $model;
    private $power;
    private $displacement;
    private $efficiency;


    public function __construct(string $model, int $power, $displacement = 'n/a', $efficiency = 'n/a')
    {
        $this->model = $model;
        $this->power = $power;
        $this->displacement = $displacement;
        $this->efficiency = $efficiency;
    }


    public function getModel(): string
    {
        return $this->model;
    }

    public function getPower(): int
    {
        return $this->power;
    }


    public function getDisplacement()
    {
        return $this->displacement;
    }


    public function getEfficiency()
    {
        return $this->efficiency;
    }


}

$n = intval(readline());
$engines = [];
$cars = [];

for ($i = 0; $i < $n; $i++) {
    $input = readline();
    $args = explode(' ', $input);
    if (count($args) === 3) {
        if (ctype_digit($args[2])) {
            $engine = new EngineSalesman($args[0], $args[1], $args[2]);
        } else {
            $engine = new EngineSalesman($args[0], $args[1], 'n/a', $args[2]);
        }
    } elseif (count($args) === 2) {
        $engine = new EngineSalesman($args[0], $args[1]);
    } else {
        $engine = new EngineSalesman($args[0], $args[1], $args[2], $args[3]);
    }

    $engines[$args[0]] = $engine;
}

$m = intval(readline());

for ($j = 0; $j < $m; $j++) {
    $input = readline();
    $args = explode(' ', $input);
    if (key_exists($args[1], $engines)) {
        if (count($args) === 3) {
            if (ctype_digit($args[2])) {
                $car = new CarSalesman($args[0], $engines[$args[1]], $args[2]);
            } else {
                $car = new CarSalesman($args[0], $engines[$args[1]], 'n/a', $args[2]);
            }
        } elseif (count($args) === 2) {
            $car = new CarSalesman($args[0], $engines[$args[1]]);
        } else {
            $car = new CarSalesman($args[0], $engines[$args[1]], $args[2], $args[3]);
        }
        $cars[] = $car;
    } else {
        continue;
    }
}

foreach ($cars as $car) {
    echo $car;
}
