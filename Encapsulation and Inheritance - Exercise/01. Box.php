<?php

class Box
{
    /**
     * @var $length float
     */
    private $length;
    /**
     * @var $width float
     */
    private $width;
    /**
     * @var $height float
     */
    private $height;

    /**
     * Box constructor.
     * @param float $length
     * @param float $width
     * @param float $height
     */
    public function __construct(float $length, float $width, float $height)
    {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
    }

    public function calculateSurfaceArea(): float
    {
        $length = $this->length;
        $width = $this->width;
        $height = $this->height;

        return 2 * $length * $width + 2 * $length * $height + 2 * $width * $height;
    }

    public function calculateLateralSurfaceArea(): float
    {
        $length = $this->length;
        $width = $this->width;
        $height = $this->height;

        return 2 * $length * $height + 2 * $width * $height;
    }

    public function calculateVolume(): float
    {
        $length = $this->length;
        $width = $this->width;
        $height = $this->height;

        return $length * $width * $height;
    }

    public function __toString()
    {
        $surfaceArea = number_format($this->calculateSurfaceArea(),2, '.', '');
        $lateralSurfaceArea = number_format($this->calculateLateralSurfaceArea(),2, '.', '');
        $volume = number_format($this->calculateVolume(),2, '.', '');

        $output = "Surface Area - $surfaceArea".PHP_EOL;
        $output .= "Lateral Surface Area - $lateralSurfaceArea".PHP_EOL;
        $output .= "Volume - $volume".PHP_EOL;

        return $output;
    }

}

$length = floatval(readline());
$width = floatval(readline());
$height = floatval(readline());

$box = new Box($length, $width, $height);

echo $box;