<?php

interface vehicleInterface
{
    public function drive(float $distance): void;

    public function refuel(float $liters): void;

}

abstract class Vehicle
{
    /**
     * @var float
     */
    protected $fuelQuantity;
    /**
     * @var float
     */
    protected $consumption;

    /**
     * @return float
     */

    /**
     * Vehicle constructor.
     * @param float $fuel
     * @param float $consumption
     */

    public function __construct(float $fuel, float $consumption)
    {
        $this->setFuelQuantity($fuel);
        $this->setConsumption($consumption);
    }

    public function getFuelQuantity(): float
    {
        return $this->fuelQuantity;
    }

    /**
     * @param float $fuelQuantity
     */
    protected function setFuelQuantity(float $fuelQuantity): void
    {
        $this->fuelQuantity = $fuelQuantity;
    }

    /**
     * @return float
     */
    public function getConsumption(): float
    {
        return $this->consumption;
    }

    /**
     * @param float $consumption
     */
    protected function setConsumption(float $consumption): void
    {
        $this->consumption = $consumption;
    }


}

class Car01 extends Vehicle implements vehicleInterface
{

    private const INCREASED_CONSUMPTION = 0.9;

    /**
     * Car01 constructor.
     * @param float $fuel
     * @param float $consumption
     */
    public function __construct(float $fuel, float $consumption)
    {
        parent::__construct($fuel, $consumption);
    }


    public function drive(float $distance): void
    {
        $fuelConsumption = $this->getConsumption() + self::INCREASED_CONSUMPTION;
        if ($distance <= $this->getFuelQuantity() / $fuelConsumption) {
            $this->fuelQuantity -=
                $fuelConsumption * $distance;
            echo "Car travelled $distance km" . PHP_EOL;
        } else {
            echo "Car needs refueling" . PHP_EOL;
        }
    }

    public function refuel(float $liters): void
    {
        $this->setFuelQuantity($this->getFuelQuantity() + $liters);
    }

    public function __toString()
    {
        return 'Car: ' . number_format($this->getFuelQuantity(), 2, '.', '');
    }
}

class Truck01 extends Vehicle implements vehicleInterface
{

    private const INCREASED_CONSUMPTION = 1.6;
    private const HOLE_IN_TANK = 0.95;

    /**
     * Truck01 constructor.
     * @param float $fuel
     * @param float $consumption
     */

    public function __construct(float $fuel, float $consumption)
    {
        parent::__construct($fuel, $consumption);
    }

    public function drive(float $distance): void
    {
        $fuelConsumption = $this->getConsumption() + self::INCREASED_CONSUMPTION;
        if ($distance <= $this->getFuelQuantity() / $fuelConsumption) {
            $this->fuelQuantity -=
                $fuelConsumption * $distance;
            echo "Truck travelled $distance km" . PHP_EOL;
        } else {
            echo "Truck needs refueling" . PHP_EOL;
        }
    }

    public function refuel(float $liters): void
    {
        $this->fuelQuantity += ($liters * self::HOLE_IN_TANK);
    }

    public function __toString()
    {
        return 'Truck: ' . number_format($this->getFuelQuantity(), 2, '.', '');
    }
}

$carData = explode(' ', readline());
$carFuel = floatval($carData[1]);
$carConsumption = floatval($carData[2]);
$car = new Car01($carFuel, $carConsumption);

$truckData = explode(' ', readline());
$truckFuel = floatval($truckData[1]);
$truckConsumption = floatval($truckData[2]);
$truck = new Truck01($truckFuel, $truckConsumption);

$n = intval(readline());

for ($i = 0; $i < $n; $i++) {
    list ($command, $vehicle, $parameter) = explode(' ', readline());
    if ($command === 'Drive' && $vehicle === 'Car') {
        $car->drive($parameter);
    }
    if ($command === 'Drive' && $vehicle === 'Truck') {
        $truck->drive($parameter);
    }
    if ($command === 'Refuel' && $vehicle === 'Car') {
        $car->refuel($parameter);
    }
    if ($command === 'Refuel' && $vehicle === 'Truck') {
        $truck->refuel($parameter);
    }
}

echo $car . PHP_EOL . $truck;