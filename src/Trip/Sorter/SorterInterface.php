<?php

namespace Trip\Sorter;

use Trip\Model\Transfer\TransferCollection;

/**
 * Interface SorterInterface
 */
interface SorterInterface
{
    /**
     * @param TransferCollection $transfers
     */
    public function sort(TransferCollection $transfers);
}