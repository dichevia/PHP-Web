<?php

class DecimalNumber
{
    private $number;

    public function __construct(string $number)
    {
        $this->number = $number;
    }

    public function printAllDigitsRev(): string
    {
        $revString = '';
        for ($i = strlen($this->number) - 1; $i >= 0; $i--) {
            $revString .= $this->number[$i];
        }
        return $revString;
    }
}

$input = readline();
$num = new DecimalNumber($input);
echo $num->printAllDigitsRev();