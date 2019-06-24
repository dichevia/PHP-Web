<?php

class Book
{

    /**
     * @var string
     */
    protected $author;
    /**
     * @var string
     */
    protected $title;

    /**
     * @var float
     */
    protected $price;


    /**
     * Book constructor.
     * @param string $author
     * @param string $title
     * @param float $price
     * @throws Exception
     */

    public function __construct(string $author, string $title, float $price)
    {
        $this->setAuthor($author);
        $this->setTitle($title);
        $this->setPrice($price);
    }

    protected function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param string $author
     * @throws Exception
     */
    protected function setAuthor(string $author): void
    {
        $pos = strpos($author, ' ');
        if (ctype_digit($author[$pos + 1])) {
            throw new Exception('Author not valid!');
        }

        $this->title = $author;
    }

    /**
     * @param string $title
     * @throws Exception
     */
    protected function setTitle(string $title): void
    {
        if (strlen($title) < 3) {
            throw new Exception('Title not valid!');
        }

        $this->title = $title;
    }

    /**
     * @param float $price
     * @throws Exception
     */
    protected function setPrice(float $price): void
    {
        if ($price < 1) {
            throw new Exception('Price not valid!');
        }
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'OK' . PHP_EOL . $this->getPrice();
    }
}

class GoldenEditionBook extends Book
{

    public function __construct(string $author, string $title, float $price)
    {
        parent::__construct($author, $title, $price);
    }

    /**
     * @throws Exception
     */
    public function getPrice(): float
    {
        return parent::getPrice() * 1.3;
    }
}

$author = readline();
$title = readline();
$price = floatval(readline());
$type = readline();

if ($type === 'STANDARD') {
    try {
        $book = new Book($author, $title, $price);
        echo $book;
    } catch (Exception $exception) {
        echo $exception->getMessage();
        return;
    }
} elseif ($type === 'GOLD') {
    try {
        $goldBook = new GoldenEditionBook($author, $title, $price);
        echo $goldBook;
    } catch (Exception $exception) {
        echo $exception->getMessage();
        return;
    }
} else {
    echo "Type is not valid!";
}
