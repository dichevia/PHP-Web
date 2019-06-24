<?php

class Car
{
    private $model;
    private $fuelAmount;
    private $fuelCostFor1Kilometer;
    private $distanceTravelled;

    public function __construct(string $model, float $fuelAmount, float $fuelCostFor1Kilometer, int $distanceTravelled = 0)
    {
        $this->model = $model;
        $this->fuelAmount = $fuelAmount;
        $this->fuelCostFor1Kilometer = $fuelCostFor1Kilometer;
        $this->distanceTravelled = $distanceTravelled;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getFuelAmount(): float
    {
        return $this->fuelAmount;
    }

    public function getDistanceTravelled(): float
    {
        return $this->distanceTravelled;
    }

    public function canCarMove(float $distance): void
    {

        if (round($distance * $this->fuelCostFor1Kilometer, 2) <= round($this->fuelAmount, 2)) {
            $this->fuelAmount -= $distance * $this->fuelCostFor1Kilometer;
            $this->distanceTravelled += $distance;
        } else {
            echo "Insufficient fuel for the drive" . PHP_EOL;
        }

    }

    public function __toString()
    {
        //AudiA4 17.60 18
        return $this->getModel() . ' ' . number_format(round($this->fuelAmount, 2, PHP_ROUND_HALF_UP), 2, '.', '')
            . ' ' . $this->distanceTravelled;
    }
}

$n = intval(readline());
$cars = [];

for ($i = 0; $i < $n; $i++) {
    $input = readline();
    list($model, $fuelAmount, $fuelCostFor1Km) = explode(' ', $input);
    $car = new CarData($model, $fuelAmount, $fuelCostFor1Km);
    $cars[$model] = $car;
}

while (true) {
    $input = readline();
    if ($input === 'End') {
        break;
    }
    $args = explode(' ', $input);
    $command = $args[0];
    if ($command === 'Drive') {
        $model = $args[1];
        $amountOfKilometers = $args[2];
        $cars[$model]->canCarMove($amountOfKilometers);
    }
}

foreach ($cars as $car) {
    echo $car . PHP_EOL;
}