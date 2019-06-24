<?php

class Person03
{
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var float $money
     */
    private $money;
    /**
     * @var array $bagOfProducts
     */
    private $bagOfProducts;

    /**
     * Person03 constructor.
     * @param string $name
     * @param float $money
     * @throws Exception
     */

    public function __construct(string $name, float $money)
    {
        $this->setName($name);
        $this->setMoney($money);
        $this->bagOfProducts = [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getMoney(): float
    {
        return $this->money;
    }

    /**
     * @param $name
     * @throws Exception
     */
    private function setName($name): void
    {
        if (empty($name)) {
            throw new Exception('Name cannot be empty' . PHP_EOL);
        }
        $this->name = $name;
    }

    /**
     * @param $money
     * @throws Exception
     */

    private function setMoney($money): void
    {
        if ($money < 0) {
            throw new Exception('Money cannot be negative' . PHP_EOL);
        }
        $this->money = $money;
    }

    /**
     * @return array
     */
    public function getBagOfProducts(): array
    {
        return $this->bagOfProducts;
    }

    /**
     * @param Product03 $product
     */
    private function addProduct(Product03 $product): void
    {
        $this->bagOfProducts[] = $product;
    }

    /**
     * @param Product03 $product
     * @throws Exception
     */
    public function BuyProduct(Product03 $product)
    {
        if ($this->getMoney() >= $product->getCost()) {
            $moneyLeft = $this->getMoney() - $product->getCost();
            $this->setMoney($moneyLeft);
            $this->addProduct($product);
            $productName = $product->getName();
            echo "$this->name bought $productName" . PHP_EOL;
        } else {
            $productName = $product->getName();
            throw new Exception("$this->name can't afford $productName\n");
        }
    }

    public function __toString()
    {
        /**
         * @var Product03 $product
         */
        if (empty($this->getBagOfProducts())) {
            return $this->getName() . ' - Nothing bought';
        }
        $products = [];
        $output = $this->getName() . ' - ';

        foreach ($this->getBagOfProducts() as $product) {
            $products[] = $product->getName();
        }
        $output .= implode(',', $products) . PHP_EOL;

        return $output;
    }
}

class Product03
{

    /**
     * @var string $name
     */
    private $name;
    /**
     * @var float;
     */
    private $cost;

    /**
     * Product03 constructor.
     * @param string $name
     * @param float $cost
     */
    public function __construct(string $name, float $cost)
    {

        $this->setName($name);
        $this->setCost($cost);

    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    private function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    private function setCost(float $cost): void
    {
        $this->cost = $cost;
    }


}


$input = preg_split('/[;=]/', readline());
$customers = [];
for($i=0; $i<count($input)-1;$i+=2) {
    $name = $input[$i];
    $money = floatval($input[$i+1]);
    try {
        $customer = new Person03($name, $money);
    } catch (Exception $e) {
        echo $e->getMessage();
        return;
    }
    $customers[$name] = $customer;
}

$input = preg_split('/[;=]/', readline());
$products = [];
for($i=0; $i<count($input)-1;$i+=2) {
    $name = $input[$i];
    $cost = floatval($input[$i+1]);
    try {
        $product = new Product03($name, $cost);
    } catch (Exception $e) {
        echo $e->getMessage();
        return;
    }
    $products[$name] = $product;
}

while (true) {
    $input = readline();
    if ($input == 'END') {
        break;
    }
    list($name, $product) = explode(' ', $input);

    if (key_exists($name, $customers) && key_exists($product, $products)) {
        /**
         * @var Person03 $customer
         * @var Product03 $productToBuy
         */
        $customer = $customers[$name];
        $productToBuy = $products[$product];
        try {
            $customer->BuyProduct($productToBuy);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

foreach ($customers as $customer) {
    echo $customer;
}