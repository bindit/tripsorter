<?php

namespace Trip\Model\Transfer;

class Train extends Transfer
{
    /**
     * @var string
     */
    protected $platform;

    /**
     * @return string
     */
    public function getDescription()
    {
        $seat = $this->seat ? "Sit in a seat {$this->seat}" : "No seat assignment";

        return "Take train {$this->id} from {$this->getFrom()}. " .
                "Platform {$this->platform}. {$seat}. {$this->additionalInfo}";
    }

    /**
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }
}