<?php

class Trainer
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $badges;
    /**
     * @var array
     */
    private $pokemons;

    /**
     * Trainer constructor.
     * @param string $name
     * @param Pokemon $pokemon
     */

    public function __construct(string $name, Pokemon $pokemon)
    {
        $this->name = $name;
        $this->badges = 0;
        $this->pokemons[$pokemon->getName()] = $pokemon;
    }

    /**
     * @param Pokemon $pokemon
     */
    public function AddPokemon(Pokemon $pokemon): void
    {
        $this->pokemons[$pokemon->getName()] = $pokemon;
    }


    public function IncreaseBadges(): void
    {
        $this->badges += 1;
    }

    /**
     * @return int
     */
    public function getBadges(): int
    {
        return $this->badges;
    }


    /**
     * @param string $element
     * @return bool
     */
    public function CheckElement(string $element): bool
    {

        $pokemons = $this->pokemons;
        /**
         * @var Pokemon $pokemon
         */
        foreach ($pokemons as $pokemon) {
            if ($pokemon->getElement() === $element) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getPokemons(): array
    {
        return $this->pokemons;
    }

    public function removePokemon(Pokemon $pokemonToRemove): void
    {
        $pokemons = $this->pokemons;
        /**
         * @var Pokemon $pokemon
         */
        foreach ($pokemons as $pokemon) {
            if ($pokemon->getName() === $pokemonToRemove->getName()) {
                $key = $pokemon->getName();
                unset($this->pokemons[$key]);
            }
        }
    }

    public function __toString()
    {
        return $this->name . ' ' . $this->badges . ' ' . count($this->getPokemons()) . PHP_EOL;
    }

}

class Pokemon
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $element;
    /**
     * @var integer
     */
    private $health;

    /**
     * Pokemon constructor.
     * @param string $name
     * @param string $element
     * @param int $health
     */
    public function __construct(string $name, string $element, int $health)
    {
        $this->name = $name;
        $this->element = $element;
        $this->health = $health;
    }

    /**
     * @return string
     */
    public function getElement(): string
    {
        return $this->element;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    public function DecreaseHealth(): void
    {
        $this->health -= 10;
    }

    public function isAlive(): bool
    {
        if ($this->getHealth() <= 0) {
            return false;
        }

        return true;
    }

}

$trainers = [];

while (true) {
    $input = readline();

    if ($input === 'Tournament') {
        break;
    }

    list($trainerName, $pokemonName, $pokemonElement, $pokemonHealth) = explode(' ', $input);
    $pokemon = new Pokemon($pokemonName, $pokemonElement, $pokemonHealth);

    if (!key_exists($trainerName, $trainers)) {
        $trainer = new Trainer($trainerName, $pokemon);
        $trainers[$trainerName] = $trainer;
    } else {
        $trainers[$trainerName]->AddPokemon($pokemon);
    }

}


while (true) {
    $element = readline();

    if ($element === 'End') {
        break;
    }
    /**
     * @var Trainer $trainer
     */
    foreach ($trainers as $trainer) {
        if ($trainer->CheckElement($element)) {
            $trainer->IncreaseBadges();
        } else {
            $pokemons = $trainer->getPokemons();
            /**
             * @var Pokemon $pokemon
             */
            foreach ($pokemons as $pokemon) {
                $pokemon->DecreaseHealth();
                if ($pokemon->isAlive() === false) {
                    $trainer->removePokemon($pokemon);
                }
            }
        }
    }
}


usort($trainers, function ($trainer1, $trainer2) {
    /**
     * @var Trainer $trainer1
     * @var Trainer $trainer2
     */

    return $trainer2->getBadges() <=> $trainer1->getBadges();
});

/**
 * @var Trainer $trainer
 */

foreach ($trainers as $trainer) {
    echo $trainer;
}