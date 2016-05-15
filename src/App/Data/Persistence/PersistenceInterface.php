<?php

namespace App\Data\Persistence;

/**
 * Interface PersistenceInterface
 */
interface PersistenceInterface
{
    /**
     * @param $table
     * @return array
     */
    public function findAll($table);
}