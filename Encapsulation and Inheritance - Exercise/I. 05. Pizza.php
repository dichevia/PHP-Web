<?php

class Dough
{
    /**
     * @var string
     */
    private $floorType;

    /**
     * @var string
     */
    private $bakingTechnique;

    /**
     * @var integer
     */
    private $weight;

    /**
     * @var float
     */
    private $calories;

    /**
     * Dough constructor.
     * @param string $floorType
     * @param string $bakingTechnique
     * @param int $weight
     * @throws Exception
     */
    public function __construct(string $floorType, string $bakingTechnique, int $weight)
    {
        $this->setFloorType($floorType);
        $this->setBakingTechnique($bakingTechnique);
        $this->setWeight($weight);
        $this->calculateCalories();

    }

    /**
     * @param string $floorType
     * @throws Exception
     */
    private function setFloorType(string $floorType): void

    {
        $floorType = strtolower($floorType);
        if ($floorType === 'white' || $floorType === 'wholegrain') {
            $this->floorType = $floorType;
        } else {
            throw new Exception('Invalid type of dough.');
        }


    }

    /**
     * @param string $bakingTechnique
     * @throws Exception
     */
    private function setBakingTechnique(string $bakingTechnique): void
    {
        $bakingTechnique = strtolower($bakingTechnique);
        if ($bakingTechnique === 'crispy' || $bakingTechnique === 'chewy' || $bakingTechnique === 'homemade') {
            $this->bakingTechnique = $bakingTechnique;
        } else {
            throw new Exception('Invalid type of dough.');
        }

    }

    /**
     * @param int $weight
     * @throws Exception
     */
    private function setWeight(int $weight): void
    {
        if ($weight >= 1 && $weight <= 200) {
            $this->weight = $weight;
        } else {
            throw new Exception('Dough weight should be in the range [1..200].');
        }

    }


    private function calculateCalories(): void
    {
        $typeModifier = 1;
        switch ($this->floorType) {
            case 'white':
                $typeModifier = 1.5;
                break;
            case 'wholegrain':
                $typeModifier = 1.0;
                break;
        }

        $techniqueModifier = 1;

        switch ($this->bakingTechnique) {
            case 'crispy':
                $techniqueModifier = 0.9;
                break;
            case 'chewy':
                $techniqueModifier = 1.1;
                break;
            case 'homemade':
                $techniqueModifier = 1.0;
                break;
        }

        $calories = $this->weight * 2 * $typeModifier * $techniqueModifier;
        $this->calories = $calories;
    }


    /**
     * @return float
     */
    public function getCalories(): float
    {
        return $this->calories;
    }

}

class Topping
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $weight;

    /**
     * @var float
     */
    private $calories;

    /**
     * Topping constructor.
     * @param string $type
     * @param $weight
     * @throws Exception
     */
    public function __construct(string $type, int $weight)
    {
        $this->setType($type);
        $this->setWeight($weight);
        $this->calculateCalories();
    }

    /**
     * @param string $type
     * @throws Exception
     */
    private function setType(string $type): void
    {
        $checker = strtolower($type);
        if ($checker === 'meat' || $checker === 'veggies' || $checker === 'cheese' || $checker === 'sauce') {
            $this->type = $type;
        } else {
            throw new Exception("Cannot place $type on top of your pizza.");
        }

    }

    /**
     * @param int $weight
     * @throws Exception
     */
    private function setWeight(int $weight): void
    {
        if ($weight >= 1 && $weight <= 50) {
            $this->weight = $weight;
        } else {
            $type = $this->type;
            throw new Exception("$type weight should be in the range [1..50].");
        }
    }

    private function calculateCalories(): void
    {
        $typeModifier = 1;
        switch (strtolower($this->type)) {
            case 'meat':
                $typeModifier = 1.2;
                break;
            case 'veggies':
                $typeModifier = 0.8;
                break;
            case 'cheese':
                $typeModifier = 1.1;
                break;
            case 'sauce':
                $typeModifier = 0.9;
                break;
        }


        $calories = $this->weight * 2 * $typeModifier;
        $this->calories = $calories;
    }

    /**
     * @return float
     */
    public function getCalories(): float
    {
        return $this->calories;
    }

}

class Pizza
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $toppings;

    /**
     * @var Dough
     */
    private $dough;

    /**
     * @var float
     */
    private $totalCalories;

    /**
     * Pizza constructor.
     * @param string $name
     * @throws Exception
     */
    public function __construct(string $name)
    {
        $this->setName($name);

    }

    public function calculateAllCalories(): void
    {
        $allCalories = 0;

        foreach ($this->toppings as $topping) {
            /**
             * @var Topping $topping
             */
            $allCalories += $topping->getCalories();
        }


        $allCalories += $this->dough->getCalories();

        $this->totalCalories = $allCalories;
    }

    /**
     * @param string $name
     * @throws Exception
     */
    private function setName(string $name): void
    {
        if (!empty($name) && strlen($name) >= 1 && strlen($name) <= 15) {
            $this->name = $name;
        } else {
            throw new Exception("Pizza name should be between 1 and 15 symbols.");
        }

    }

    /**
     * @param Topping $topping
     */
    public function addTopping(Topping $topping): void
    {
        $this->toppings[] = $topping;
    }

    /**
     * @param Dough $dough
     */
    public function setDough(Dough $dough): void
    {
        $this->dough = $dough;
    }


    public function __toString()
    {

//        Meatless – 370.00 Calories.
        return $this->name . ' - ' . number_format($this->totalCalories, 2, '.', '') . ' Calories.';
    }

}

list($pizza, $pizzaName, $countToppings) = explode(' ', readline());
$countToppings = intval($countToppings);

if ($countToppings < 0 || $countToppings > 10) {
    echo 'Number of toppings should be in range [0..10].';
    return;
}

list($dough, $doughType, $doughTechnique, $doughWeight) = explode(' ', readline());
$doughWeight = intval($doughWeight);


try {
    $doughObject = new Dough($doughType, $doughTechnique, $doughWeight);
    $pizzaObject = new Pizza($pizzaName);
    $pizzaObject->setDough($doughObject);
    for ($i = 0; $i < $countToppings; $i++) {
        list ($topping, $toppingType, $toppingWeight) = explode(' ', readline());
        $toppingObject = new Topping($toppingType, $toppingWeight);
        $pizzaObject->addTopping($toppingObject);
    }
    $pizzaObject->calculateAllCalories();
} catch (Exception $exception) {
    echo $exception->getMessage();
    return;
}

echo $pizzaObject;