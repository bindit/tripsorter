<?php

namespace Trip\Model\Transfer;

class Bus extends Transfer
{
    /**
     * @return string
     */
    public function getDescription()
    {
        $seat = $this->seat ? "Seat {$this->seat}": "No seat assignment";

        return
            "Take bus {$this->id} from {$this->getFrom()} to {$this->getTo()}. {$seat}. " .
            "{$this->additionalInfo}";
    }
}