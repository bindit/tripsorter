<?php

namespace Trip\Model\Transfer;

/**
 * Class TransferCollection
 */
class TransferCollection implements TransferCollectionInterface
{
    /**
     * @var array
     */
    protected $transfers = [];

    /**
     * @param array $transfers
     */
    public function __construct($transfers = [])
    {
        $this->setTransfers($transfers);
    }

    /**
     * @param Transfer $transfer
     */
    public function addTransfer(Transfer $transfer)
    {
        $this->transfers[] = $transfer;
    }

    /**
     * @return array
     */
    public function getTransfers()
    {
        return $this->transfers;
    }

    /**
     * @param array $transfers
     */
    public function setTransfers($transfers = [])
    {
        $this->transfers = [];
        array_walk($transfers, [$this, 'addTransfer']);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->transfers);
    }

    /**
     * @param $key
     * @return Transfer
     */
    public function get($key)
    {
        return $this->transfers[$key];
    }
}