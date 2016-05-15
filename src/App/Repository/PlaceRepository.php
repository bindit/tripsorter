<?php

namespace App\Repository;

use App\Data\Persistence\PersistenceInterface;
use App\Exception\NoResultsFoundException;
use Trip\Model\Place\Place;
use Trip\Model\Place\PlaceRepositoryInterface;

/**
 * Class PlaceRepository
 */
class PlaceRepository implements PlaceRepositoryInterface
{
    /**
     * @var PersistenceInterface
     */
    protected $persistence;

    /**
     * @param PersistenceInterface $persistence
     */
    public function __construct(PersistenceInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    /**
     * @param int $id
     * @return Place
     * @throws NoResultsFoundException
     */
    public function find($id)
    {
        $filtered = array_filter($this->persistence->findAll('place'), function ($transfer) use ($id) {
            return $transfer['id'] == $id;
        });

        if (!count($filtered)) {
            throw new NoResultsFoundException(Place::class, $id);
        }

        return new Place(reset($filtered)['id'], reset($filtered)['name']);
    }
}