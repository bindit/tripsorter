<?php

namespace App\Repository;

use App\Data\Persistence\PersistenceInterface;
use App\Exception\NoResultsFoundException;
use Trip\Factory\FactoryInterface;
use Trip\Model\Transfer\Transfer;
use Trip\Model\Transfer\TransferRepositoryInterface;

/**
 * Class TransferRepository
 */
class TransferRepository implements TransferRepositoryInterface
{
    /**
     * @var PersistenceInterface
     */
    protected $persistence;

    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @param PersistenceInterface $persistence
     * @param FactoryInterface $factory
     */
    public function __construct(PersistenceInterface $persistence, FactoryInterface $factory)
    {
        $this->persistence = $persistence;
        $this->factory = $factory;
    }

    /**
     * @param string $id
     * @return Transfer
     * @throws NoResultsFoundException
     */
    public function find($id)
    {
        $filtered = array_filter($this->persistence->findAll('transfer'), function ($transfer) use ($id) {
            return $transfer['id'] == $id;
        });

        if (!count($filtered)) {
            throw new NoResultsFoundException(Transfer::class, $id);
        }

        return $this->factory->make(reset($filtered)['type'], reset($filtered));
    }
}