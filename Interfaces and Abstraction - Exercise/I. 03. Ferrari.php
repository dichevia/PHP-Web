<?php

interface FerrariInterface
{
    public function useBreaks(): void;

    public function pushTheGasPedal(): void;
}

class Ferrari implements FerrariInterface
{

    const FERRARI_MODEL = '488-Spider';

    /**
     * @var string
     */
    private $model;
    /**
     * @var string
     */
    private $driver;

    /**
     * Ferrari constructor.
     * @param string $name
     */

    public function __construct(string $name)
    {
        $this->model = self::FERRARI_MODEL;
        $this->setDriver($name);

    }

    /**
     * @param string $driver
     */

    private function setDriver(string $driver): void
    {
        $this->driver = $driver;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }


    public function useBreaks(): void
    {
        echo 'Brakes!';
    }

    public function pushTheGasPedal(): void
    {
        echo 'Zadu6avam sA!';
    }

}

$inputName = readline();

$ferrari = new Ferrari($inputName);

echo $ferrari->getModel() . '/';
echo $ferrari->useBreaks() . '/';
echo $ferrari->pushTheGasPedal() . '/';
echo $ferrari->getDriver();