<?php

interface CallingInterface
{
    public function Calling(): void;
}

interface BrowsingInterface
{
    public function Browsing(): void;
}

class Smartphone implements CallingInterface, BrowsingInterface
{

    /**
     * @var array
     */
    private $phoneNumbers;

    /**
     * @var array
     */
    private $webSites;

    /**
     * Smartphone constructor.
     * @param string $numbers
     * @param string $webSites
     */

    public function __construct(string $numbers, string $webSites)
    {
        $this->addNumbers($numbers);
        $this->addWebSites($webSites);
    }

    /**
     * @param string $numbers
     */
    private function addNumbers(string $numbers): void
    {
        $numbers = explode(' ', $numbers);
        $this->phoneNumbers = $numbers;
    }

    /**
     * @param string $webSites
     */
    private function addWebSites(string $webSites): void
    {
        $webSites = explode(' ', $webSites);
        $this->webSites = $webSites;
    }

    public function Calling(): void
    {
        foreach ($this->phoneNumbers as $number) {
            if (ctype_digit($number)) {
                echo 'Calling... ' . $number . PHP_EOL;
            } else {
                echo 'Invalid number!' . PHP_EOL;
            }
        }
    }

    public function Browsing(): void
    {
        foreach ($this->webSites as $webSite) {
            if (!preg_match('/[0-9]/', $webSite)) {
                echo 'Browsing: ' . $webSite . '!' . PHP_EOL;
            } else {
                echo 'Invalid URL!' . PHP_EOL;
            }
        }
    }
}

$numbers = readline();
$webSites = readline();

$smartphone = new Smartphone($numbers, $webSites);

$smartphone->Calling();
$smartphone->Browsing();