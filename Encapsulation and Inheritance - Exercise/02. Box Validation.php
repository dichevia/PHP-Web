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
     * @throws Exception
     */
    public function __construct(float $length, float $width, float $height)
    {
        $this->setLength($length);
        $this->setWidth($width);
        $this->setHeight($height);
    }

    /**
     * @param float $length
     * @throws Exception
     */
    private function setLength(float $length): void
    {
        if ($length < 1) {
            throw new Exception('Length cannot be zero or negative.');
        }
        $this->length = $length;
    }

    /**
     * @param float $width
     * @throws Exception
     */
    private function setWidth(float $width): void
    {
        if ($width < 1) {
            throw new Exception('Width cannot be zero or negative.');
        }
        $this->width = $width;
    }

    /**
     * @param float $height
     * @throws Exception
     */
    private function setHeight(float $height): void
    {
        if ($height < 1) {
            throw new Exception('Height cannot be zero or negative.');
        }
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
        $surfaceArea = number_format($this->calculateSurfaceArea(), 2, '.', '');
        $lateralSurfaceArea = number_format($this->calculateLateralSurfaceArea(), 2, '.', '');
        $volume = number_format($this->calculateVolume(), 2, '.', '');

        $output = "Surface Area - $surfaceArea" . PHP_EOL;
        $output .= "Lateral Surface Area - $lateralSurfaceArea" . PHP_EOL;
        $output .= "Volume - $volume" . PHP_EOL;

        return $output;
    }

}

$length = floatval(readline());
$width = floatval(readline());
$height = floatval(readline());

try {
    $box = new Box($length, $width, $height);
} catch (Exception $exception) {
    echo $exception->getMessage();
    return;
}

echo $box;