<?php

interface vehicleInterface02
{
    public function drive(float $distance): void;

    public function refuel(float $liters): void;

}


class VehicleFactory
{

    static function createObject(string $input)
    {
        $data = explode(' ', $input);
        $vehicle = $data[0];
        $fuel = floatval($data[1]);
        $consumption = floatval($data[2]);
        $tankCapacity = floatval($data[3]);
        if ($vehicle === 'Car' && $fuel > $tankCapacity) {
            echo "Cannot fit fuel in tank" . PHP_EOL;
            $fuel = 0;
        }
        if ($vehicle === 'Bus' && $fuel > $tankCapacity) {
            echo "Cannot fit fuel in tank" . PHP_EOL;
            $fuel = 0;
        }


        switch ($vehicle) {
            case 'Car':
                return $car = new Car02($fuel, $consumption, $tankCapacity);
            case 'Truck':
                return $truck = new Truck02($fuel, $consumption, $tankCapacity);
            default:
                return $bus = new Bus02($fuel, $consumption, $tankCapacity);
        }
    }
}

abstract class Vehicle02
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
     * @var float
     */
    protected $tankCapacity;

    /**
     * Vehicle constructor.
     * @param float $fuel
     * @param float $consumption
     * @param float $tankCapacity
     */

    public function __construct(float $fuel, float $consumption, $tankCapacity)
    {
        $this->setFuelQuantity($fuel);
        $this->setConsumption($consumption);
        $this->setTankCapacity($tankCapacity);
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
        if ($fuelQuantity < 0) {
            echo 'Fuel must be a positive number.' . PHP_EOL;
            $fuelQuantity = 0;
        }
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

    /**
     * @return float
     */
    public function getTankCapacity(): float
    {
        return $this->tankCapacity;
    }

    /**
     * @param float $tankCapacity
     */
    public function setTankCapacity(float $tankCapacity): void
    {

        $this->tankCapacity = $tankCapacity;
    }


}

class Car02 extends Vehicle02 implements vehicleInterface02
{

    private const INCREASED_CONSUMPTION = 0.9;

    /**
     * Car01 constructor.
     * @param float $fuel
     * @param float $consumption
     * @param float $tankCapacity
     */
    public function __construct(float $fuel, float $consumption, $tankCapacity)
    {
        parent::__construct($fuel, $consumption, $tankCapacity);
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
        $refuel = $liters + $this->getFuelQuantity();

        if ($this->getTankCapacity() >= $refuel) {
            if ($liters + $this->getFuelQuantity() >= 0) {
                $this->setFuelQuantity($this->getFuelQuantity() + $liters);
            } else {
                echo "Fuel must be a positive number" . PHP_EOL;
            }
        } else {
            echo "Cannot fit fuel in tank" . PHP_EOL;
        }

    }

    public function __toString()
    {
        return 'Car: ' . number_format($this->getFuelQuantity(), 2, '.', '');
    }
}

class Truck02 extends Vehicle02 implements vehicleInterface02
{

    private const INCREASED_CONSUMPTION = 1.6;
    private const HOLE_IN_TANK = 0.95;

    /**
     * Truck01 constructor.
     * @param float $fuel
     * @param float $consumption
     * @param float $tankCapacity
     */

    public function __construct(float $fuel, float $consumption, $tankCapacity)
    {
        parent::__construct($fuel, $consumption, $tankCapacity);
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

        if ($liters + $this->getFuelQuantity() >= 0) {
            $this->fuelQuantity += ($liters * self::HOLE_IN_TANK);
        } else {
            echo "Fuel must be a positive number" . PHP_EOL;
        }

    }

    public function __toString()
    {
        return 'Truck: ' . number_format($this->getFuelQuantity(), 2, '.', '');
    }
}

class Bus02 extends Vehicle02 implements vehicleInterface02
{

    private const INCREASED_CONSUMPTION = 1.4;

    /**
     * @var bool
     */
    private $people;

    /**
     * Bus02 constructor.
     * @param float $fuel
     * @param float $consumption
     * @param float $tankCapacity
     */

    public function __construct(float $fuel, float $consumption, float $tankCapacity)
    {
        parent::__construct($fuel, $consumption, $tankCapacity);
        $this->setPeople(true);
    }

    /**
     * @return bool
     * @param string
     */
    public function isPeople(string $parameter): bool
    {
        if ($parameter === 'DriveEmpty') {
            return $this->people = false;
        }
        return $this->people = true;
    }

    /**
     * @param bool $people
     */
    public function setPeople(bool $people): void
    {
        $this->people = $people;
    }


    public function drive(float $distance): void
    {
        if ($this->people === true) {
            $fuelConsumption = $this->getConsumption() + self::INCREASED_CONSUMPTION;
        } else {
            $fuelConsumption = $this->getConsumption();
        }

        if ($distance <= $this->getFuelQuantity() / $fuelConsumption) {
            $this->fuelQuantity -=
                $fuelConsumption * $distance;
            echo "Bus travelled $distance km" . PHP_EOL;
        } else {
            echo "Bus needs refueling" . PHP_EOL;
        }
    }

    public function refuel(float $liters): void
    {
        $refuel = $liters + $this->getFuelQuantity();

        if ($this->getTankCapacity() >= $refuel) {
            if ($liters + $this->getFuelQuantity() >= 0) {
                $this->setFuelQuantity($this->getFuelQuantity() + $liters);
            } else {
                echo "Fuel must be a positive number" . PHP_EOL;
            }
        } else {
            echo "Cannot fit fuel in tank" . PHP_EOL;
        }
    }

    public function __toString()
    {
        return 'Bus: ' . number_format($this->getFuelQuantity(), 2, '.', '');
    }
}

$vehicles = [];

for ($i = 0; $i < 3; $i++) {
    $data = readline();
    $object = VehicleFactory::createObject($data);
    $data = explode(' ', $data);
    $type = $data[0];
    $vehicles[$type] = $object;
}

$n = intval(readline());

for ($i = 0; $i < $n; $i++) {
    list ($command, $vehicle, $parameter) = explode(' ', readline());
    if ($command === 'Drive') {
        $vehicles[$vehicle]->drive($parameter);
    }

    if ($command === 'Refuel') {
        $vehicles[$vehicle]->refuel($parameter);
    }
    if ($command === 'DriveEmpty') {
        $vehicles[$vehicle]->isPeople('DriveEmpty');
        $vehicles[$vehicle]->drive($parameter);
    }

}


echo $vehicles['Car'] . PHP_EOL;
echo $vehicles['Truck'] . PHP_EOL;
echo $vehicles['Bus'] . PHP_EOL;
