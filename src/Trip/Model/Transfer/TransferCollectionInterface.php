<?php

namespace Trip\Model\Transfer;

/**
 * Interface TransferCollectionInterface
 */
interface TransferCollectionInterface extends \Countable
{
    /**
     * @param Transfer $transfer
     */
    public function addTransfer(Transfer $transfer);

    /**
     * @return Transfer[]
     */
    public function getTransfers();

    /**
     * @param array $transfers
     */
    public function setTransfers($transfers = []);
}