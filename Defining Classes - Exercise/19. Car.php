<?php

class Car19
{
    private $speed;
    private $fuel;
    private $fuelEconomy;
    private $totalDistance;
    private $totalTravelTime;

    public function __construct($speed, $fuel, $fuelEconomy)
    {
        $this->speed = $speed;
        $this->fuel = $fuel;
        $this->fuelEconomy = $fuelEconomy;
        $this->totalDistance = 0;
        $this->totalTravelTime = 0;
    }

    public function Travel($distance)
    {
        $fuelPerKm = $this->fuelEconomy / 100;
        $neededFuel = $distance * $fuelPerKm;
        if ($neededFuel <= $this->fuel) {
            $this->totalDistance += $distance;
            $this->fuel -= $neededFuel;
            $this->totalTravelTime += $distance / $this->speed;
        } else {
            $this->totalDistance += $this->fuel / $this->fuelEconomy*100 ;
            $this->totalTravelTime += $this->fuel / $this->fuelEconomy*100 / $this->speed;
            $this->fuel = 0;
        }

    }

    public function Refuel($litres)
    {
        $this->fuel += $litres;
    }

    public function showTotalDistance()
    {

        return $this->totalDistance;
    }

    public function showTotalTravelTime()
    {
        return $this->totalTravelTime;
    }

    public function showRemainingFuel()
    {
        return $this->fuel;
    }
}

$createdCar = false;

while (true) {
    $input = readline();
    if ($input === 'END') {
        break;
    }
    if ($createdCar === false) {
        list ($speed, $fuel, $fuelEconomy) = explode(' ', $input);
        $car = new Car19($speed, $fuel, $fuelEconomy);
        $createdCar = true;
        continue;
    }

    $args = explode(' ', $input);
    $command = $args[0];

    if ($command === 'Travel') {
        $distance = $args[1];
        $car->Travel($distance);
    }
    if ($command === 'Refuel') {
        $liters = $args[1];
        $car->Refuel($liters);
    }
    if ($command === 'Distance') {
        echo 'Total Distance: ' . number_format(round($car->showTotalDistance(), 1), 1, '.', '') . PHP_EOL;
    }
    if ($command === 'Time') {
        $totalTime = $car->showTotalTravelTime();
        $hours = $totalTime % 10;
        $minutes = $totalTime * 60;
        if ($minutes % 60 == 0) {
            $minutes = 0;
        }
        $minutes = intval($minutes);
        echo "Total Time: $hours hours and $minutes minutes" . PHP_EOL;
    }
    if ($command === 'Fuel') {
        echo 'Fuel left: ' . number_format(round($car->showRemainingFuel(), 1), 1, '.', '') . ' liters' . PHP_EOL;
    }
}
