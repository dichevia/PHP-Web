<?php

class Food
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var integer
     */
    private $points;

    /**
     * Food constructor.
     * @param string $name
     * @param int $points
     */
    public function __construct(string $name, int $points)
    {
        $this->name = $name;
        $this->points = $points;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }


}

class FoodFactory
{


    /**
     * @param string $food
     * @return Food
     */
    public static function GenerateFood(string $food)
    {
        $food = strtolower($food);
        switch ($food) {
            case "apple":
                return new Food($food, 1);
            case "cram":
                return new Food($food, 2);
            case "honeycake":
                return new Food($food, 5);
            case "lembas":
                return new Food($food, 3);
            case "melon":
                return new Food($food, 1);
            case "mushrooms":
                return new Food($food, -10);
            default:
                return new Food($food, -1);
        }
    }
}

class Mood
{
    /**
     * @var string
     */
    private $mood;

    /**
     * Food constructor.
     * @param string $mood
     */
    public function __construct(string $mood)
    {
        $this->mood = $mood;
    }

    /**
     * @return string
     */
    public function getMood(): string
    {
        return $this->mood;
    }


}

class MoodFactory
{
    public static function GenerateMood(int $happiness)
    {
        if ($happiness < -5) {
            return new Mood("Angry");
        } else if ($happiness < 0) {
            return new Mood("Sad");
        } else if ($happiness <= 15) {
            return new Mood("Happy");
        } else {
            return new Mood("PHP");
        }
    }

}

class Gandalf
{
    /**
     * @var array
     */
    private $foods;

    /**
     * @var string
     */
    private $mood;

    public function TakeFood($foods)
    {
        $foods = explode(',', $foods);

        foreach ($foods as $food) {
            $this->foods[] = FoodFactory::GenerateFood($food);
        }
    }

    public function calculatePoints()
    {
        $points = 0;
        foreach ($this->foods as $foods) {
            $points += $foods->getPoints();
        }

        return $points;

    }

    public function CalculateMood()
    {
        /**
         * @var Food $foods
         */

        $points = 0;
        foreach ($this->foods as $foods) {
            $points += $foods->getPoints();
        }
        $this->mood = MoodFactory::GenerateMood($points);
    }

    public function __toString()
    {
        /**
         * @var Mood $fuck
         */
        $fuck = $this->mood;

        return $this->calculatePoints() . PHP_EOL . $fuck->getMood();
    }
}

$input = readline();

$gandalf = new Gandalf();
$gandalf->TakeFood($input);
$gandalf->CalculateMood();
echo $gandalf;
