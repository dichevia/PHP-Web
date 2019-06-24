<?php

class CarData
{
    /**
     * @var string
     */
    private $model;
    /**
     * @var EngineTest
     */
    private $engine;
    /**
     * @var Cargo
     */
    private $cargo;
    /**
     * @var Tyre
     */
    private $tires;

    /**
     * Car constructor.
     * @param string $model
     * @param EngineTest $engine
     * @param Cargo $cargo
     * @param Tyre $tires
     */
    public function __construct(string $model, EngineTest $engine, Cargo $cargo, Tyre $tires)
    {
        $this->model = $model;
        $this->engine = $engine;
        $this->cargo = $cargo;
        $this->tires = $tires;
    }

    /**
     * @return Cargo
     */
    public function getCargo(): Cargo
    {
        return $this->cargo;
    }

    /**
     * @return Tyre
     */
    public function getTires(): Tyre
    {
        return $this->tires;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getEngine()
    {
        return $this->engine;
    }

}

class Engine
{
    private $speed;
    private $power;

    /**
     * Engine constructor.
     * @param int $speed
     * @param int $power
     */
    public function __construct(int $speed, int $power)
    {
        $this->speed = $speed;
        $this->power = $power;
    }

    public function getEnginePower()
    {
        return $this->power;
    }
}

class Cargo
{
    /**
     * @var int $weight
     */
    private $weight;
    /**
     * @var string $type
     */
    private $type;

    /**
     * Cargo constructor.
     * @param int $weight
     * @param string $type
     */
    public function __construct(int $weight, string $type)
    {
        $this->weight = $weight;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

}

class Tyre
{
    /**
     * @var float $tire1Pressure
     */
    private $tire1Pressure;
    /**
     * @var float $tire1Pressure
     */
    private $tire1Age;
    /**
     * @var float $tire1Pressure
     */
    private $tire2Pressure;
    /**
     * @var float $tire1Pressure
     */
    private $tire2Age;
    /**
     * @var float $tire1Pressure
     */
    private $tire3Pressure;
    /**
     * @var float $tire1Pressure
     */
    private $tire3Age;
    /**
     * @var float $tire1Pressure
     */
    private $tire4Pressure;
    /**
     * @var float $tire1Pressure
     */
    private $tire4Age;

    /**
     * Tyre constructor.
     * @param float $tire1Pressure
     * @param float $tire1Age
     * @param float $tire2Pressure
     * @param float $tire2Age
     * @param float $tire3Pressure
     * @param float $tire3Age
     * @param float $tire4Pressure
     * @param float $tire4Age
     */
    public function __construct(float $tire1Pressure, float $tire1Age, float $tire2Pressure, float $tire2Age,
                                float $tire3Pressure, float $tire3Age, float $tire4Pressure, float $tire4Age)
    {
        $this->tire1Pressure = $tire1Pressure;
        $this->tire1Age = $tire1Age;
        $this->tire2Pressure = $tire2Pressure;
        $this->tire2Age = $tire2Age;
        $this->tire3Pressure = $tire3Pressure;
        $this->tire3Age = $tire3Age;
        $this->tire4Pressure = $tire4Pressure;
        $this->tire4Age = $tire4Age;
    }

    /**
     * @return float
     */
    public function getTire1Pressure(): float
    {
        return $this->tire1Pressure;
    }

    /**
     * @return float
     */
    public function getTire2Pressure(): float
    {
        return $this->tire2Pressure;
    }

    /**
     * @return float
     */
    public function getTire3Pressure(): float
    {
        return $this->tire3Pressure;
    }

    /**
     * @return float
     */
    public function getTire4Pressure(): float
    {
        return $this->tire4Pressure;
    }


}

$n = intval(readline());
$cars = [];

for ($i = 0; $i < $n; $i++) {
    $input = readline();
    list ($model, $engineSpeed, $enginePower, $cargoWeight, $cargoType,
        $tire1Pressure, $tyre1Age, $tire2Pressure, $tyre2Age, $tire3Pressure,
        $tyre3Age, $tire4Pressure, $tyre4Age) = explode(' ', $input);
    $tyre = new Tyre($tire1Pressure, $tyre1Age, $tire2Pressure, $tyre2Age, $tire3Pressure,
        $tyre3Age, $tire4Pressure, $tyre4Age);
    $cargo = new Cargo($cargoWeight, $cargoType);
    $engine = new EngineTest($engineSpeed, $enginePower);
    $car = new CarData($model, $engine, $cargo, $tyre);
    $cars[] = $car;
}

$command = readline();

if ($command === 'fragile') {
    foreach ($cars as $car) {
        /**
         * @var CarData $car
         */
        if ($car->getCargo()->getType() === $command) {
            if ($car->getTires()->getTire1Pressure() < 1 || $car->getTires()->getTire2Pressure() < 1 ||
                $car->getTires()->getTire3Pressure() < 1 || $car->getTires()->getTire4Pressure() < 1) {
                echo $car->getModel() . PHP_EOL;
            }
        }
    }
}
if ($command === 'flamable') {
    foreach ($cars as $car) {
        /**
         * @var CarData $car
         */
        if ($car->getCargo()->getType() === $command) {
            if ($car->getEngine()->getEnginePower() > 250) {
                echo $car->getModel() . PHP_EOL;
            }
        }
    }
}