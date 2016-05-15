<?php

namespace Trip\Model\Transfer;

class Flight extends Transfer
{
    /**
     * @var string
     */
    protected $gate;

    /**
     * @return string
     */
    public function getDescription()
    {
        return
            "From {$this->from}, take flight {$this->id} to {$this->to}. " .
            "Gate {$this->gate}, seat {$this->seat}. {$this->additionalInfo}";
    }

    /**
     * @return string
     */
    public function getGate()
    {
        return $this->gate;
    }

    /**
     * @param string $gate
     */
    public function setGate($gate)
    {
        $this->gate = $gate;
    }
}