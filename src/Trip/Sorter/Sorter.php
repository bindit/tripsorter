<?php

namespace Trip\Sorter;

use Trip\Exception\MissingTransferException;
use Trip\Exception\NoFirstTransferFoundException;
use Trip\Model\Transfer\Transfer;
use Trip\Model\Transfer\TransferCollection;

/**
 * Class Sorter
 */
class Sorter implements SorterInterface
{
    /**
     * @var TransferCollection
     */
    protected $toSort;

    /**
     * @param TransferCollection $transfers
     * @throws MissingTransferException
     * @throws NoFirstTransferFoundException
     */
    public function sort(TransferCollection $transfers)
    {
        $this->toSort = $transfers->getTransfers();
        $sorted[] = $transfer = $this->findFirst();

        while (count($this->toSort)) {
            $transfer = $this->findNext($transfer);
            $sorted[] = $transfer;
        }

        $transfers->setTransfers($sorted);
    }

    /**
     * @return Transfer
     * @throws NoFirstTransferFoundException
     */
    protected function findFirst()
    {
        foreach ($this->toSort as $key => $transfer) {
            if (!$this->hasPrevious($transfer)) {
                unset($this->toSort[$key]);
                return $transfer;
            }
        }

        throw new NoFirstTransferFoundException();
    }

    /**
     * @param Transfer $transfer
     * @return bool
     */
    protected function hasPrevious(Transfer $transfer)
    {
        foreach ($this->toSort as $j => $toCheck) {
            if ($this->compare($transfer, $toCheck)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Transfer $transfer
     * @return Transfer
     * @throws MissingTransferException
     */
    protected function findNext(Transfer $transfer)
    {
        foreach ($this->toSort as $key => $toCheck) {
            if ($this->compare($toCheck, $transfer)) {
                unset($this->toSort[$key]);
                return $toCheck;
            }
        }

        throw new MissingTransferException();
    }

    /**
     * @param Transfer $destination
     * @param Transfer $departure
     * @return bool
     */
    protected function compare(Transfer $destination, Transfer $departure)
    {
        return $destination->getFrom() == $departure->getTo();
    }
}