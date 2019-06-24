<?php

interface passwordInterface
{
    public function generatePassword(): void;
}

abstract class Character
{
    /**
     * @var string
     */
    protected $username;
    /**
     * @var string
     */
    protected $password;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var int
     */
    protected $level;

    /**
     * Character constructor.
     * @param string $username
     * @param string $type
     * @param int $level
     */
    public function __construct(string $username, string $type, int $level)
    {
        $this->setUsername($username);
        $this->setType($type);
        $this->setLevel($level);
        $this->password = null;
    }


    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    protected function setUsername(string $username): void
    {
        if (strlen($username) <= 10) {
            $this->username = $username;
        }

    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    protected function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    protected function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function __toString()
    {
//        ""Akasha"" | ""ahsakA"168"

        return '"' . $this->getUsername() . '"' .' | ';
    }

}

class Demon extends Character implements passwordInterface
{

    /**
     * @var float
     */
    private $energy;

    public function __construct(string $username, string $type, int $level, float $energy)
    {
        parent::__construct($username, $type, $level);
        $this->setEnergy($energy);
    }

    /**
     * @param float $energy
     */
    private function setEnergy(float $energy): void
    {
        $this->energy = $energy;
    }


    public function generatePassword(): void
    {
        $password = strlen($this->getUsername()) * 217;

        $this->password = $password;
    }

    public function __toString()
    {
        return parent::__toString() . '"' . $this->password . '"' . ' -> ' . $this->getType() .PHP_EOL.
            number_format($this->energy * $this->getLevel(), 1, '.', '');
    }
}

class Archangel extends Character implements passwordInterface
{

    /**
     * @var int
     */
    private $mana;

    public function __construct(string $username, string $type, int $level, $mana)
    {
        parent::__construct($username, $type, $level);
        $this->setMana($mana);
    }

    /**
     * @param int $mana
     */
    private function setMana(int $mana): void
    {
        $this->mana = $mana;
    }


    public function generatePassword(): void
    {
        $password = strrev($this->getUsername()) . (strlen($this->getUsername()) * 21);

        $this->password = $password;
    }

    public function __toString()
    {
        return parent::__toString() . '"' . $this->password . '"' . ' -> ' . $this->getType() .PHP_EOL.
            $this->mana * $this->getLevel();
    }
}


list ($username, $type, $specialPoints, $level) = explode(' | ', readline());

if ($type === 'Demon') {
    $demon = new Demon($username, $type, $level, $specialPoints);
    $demon->generatePassword();
    echo $demon;
}
if ($type === 'Archangel') {
    $archangel = new Archangel($username, $type, $level, $specialPoints);
    $archangel->generatePassword();
    echo $archangel;
}