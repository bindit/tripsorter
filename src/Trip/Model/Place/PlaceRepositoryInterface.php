<?php

namespace Trip\Model\Place;

/**
 * Interface PlaceRepositoryInterface
 */
interface PlaceRepositoryInterface
{
    /**
     * @param int $id
     * @return Place
     */
    public function find($id);
}
