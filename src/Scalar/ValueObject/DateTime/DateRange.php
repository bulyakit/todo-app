<?php

namespace App\Scalar\ValueObject\DateTime;

use Exception;

/**
 * Class DateRange
 *
 * @package ToDoApp\Scalar
 */
class DateRange
{
    /**
     * @var DateTime
     */
    private $start;

    /**
     * @var DateTime
     */
    private $end;

    /**
     * DateRange constructor.
     *
     * @param DateTime $start
     * @param DateTime $end
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->start = $start;
        $this->end   = $end;
    }

    /**
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param DateTime $date
     *
     * @return bool
     *
     * @throws Exception
     */
    public function containsDate(DateTime $date)
    {
        return $date->getDateTime() >= $this->start->getDateTime() && $date->getDateTime() <= $this->end->getDateTime();
    }
}
