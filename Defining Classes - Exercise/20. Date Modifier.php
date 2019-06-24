<?php

class DateModifier
{

    /**
     * @var string
     */
    private $date1;
    /**
     * @var string
     */
    private $date2;
    /**
     * @var integer
     */
    private $difference;

    /**
     * DateModifier constructor.
     * @param string $date1
     * @param  string $date2
     */
    public function __construct(string $date1, string $date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
        $this->difference = 0;
    }

    /**
     * @throws Exception
     * @return integer
     */
    public function Compare(): int
    {
        list($year1, $month1, $day1) = explode(' ', $this->date1);
        list($year2, $month2, $day2) = explode(' ', $this->date2);

        $date1 = new DateTime();
        $date1->setDate($year1, $month1, $day1);

        $date2 = new DateTime();
        $date2->setDate($year2, $month2, $day2);

        $diff = date_diff($date1, $date2);
        $diff = $diff = $diff->days;

        return $diff;

    }

    /**
     * @return string
     * @throws Exception
     */

    public function __toString()
    {
        return strval($this->Compare());
    }

}

$input1 = readline();
$input2 = readline();

$dates = new DateModifier($input1, $input2);
try {
    $dates->Compare();
} catch (Exception $e) {
}

echo $dates;
