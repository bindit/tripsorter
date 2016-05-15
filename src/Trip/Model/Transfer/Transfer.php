<?php

namespace Trip\Model\Transfer;

use Trip\Model\Id;
use Trip\Model\Place\Place;

/**
 * Class Transfer
 */
abstract class Transfer
{
    use Id;

    /**
     * @var Place
     */
    protected $from;

    /**
     * @var Place
     */
    protected $to;

    /**
     * @var string
     */
    protected $seat;

    /**
     * @var string
     */
    protected $additionalInfo;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getDescription();
    }

    /**
     * @return string
     */
    abstract function getDescription();

    /**
     * @return Place
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param Place $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return string
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @param string $seat
     */
    public function setSeat($seat)
    {
        $this->seat = $seat;
    }

    /**
     * @return string
     */
    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    /**
     * @param string $additionalInfo
     */
    public function setAdditionalInfo($additionalInfo)
    {
        $this->additionalInfo = $additionalInfo;
    }
}