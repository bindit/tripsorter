<?php

namespace Trip\Planner;

use Trip\Model\Transfer\Transfer;
use Trip\Model\Transfer\TransferCollection;
use Trip\Sorter\SorterInterface;

/**
 * Class Planner
 */
class Planner implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $plan;

    /**
     * @var SorterInterface
     */
    protected $sorter;

    /**
     * @param SorterInterface $sorter
     */
    public function __construct(SorterInterface $sorter)
    {
        $this->sorter = $sorter;
    }

    /**
     * @param TransferCollection $transfers
     */
    public function plan(TransferCollection $transfers)
    {
        $this->sorter->sort($transfers);
        $this->makePlan($transfers);
    }

    /**
     * @param TransferCollection $transfers
     */
    protected function makePlan(TransferCollection $transfers)
    {
        /** @var Transfer $transfer */
        $i = 1;
        foreach ($transfers->getTransfers() as $transfer) {
            $this->plan[] = $i++ . ". " .$transfer->getDescription();
        }

        $this->plan[] = $i++ . ". You have arrived at your final destination.";
    }

    /**
     * @return array
     */
    public function getPlan()
    {
       return $this->plan;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->getPlan();
    }
}