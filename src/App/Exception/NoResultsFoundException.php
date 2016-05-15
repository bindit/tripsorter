<?php

namespace App\Exception;

/**
 * Class NoResultsFoundException
 */
class NoResultsFoundException extends \Exception
{
    /**
     * @param string $type
     * @param string $id
     */
    public function __construct($type, $id)
    {
        parent::__construct("{$type} with id: {$id} does not exist!");
    }
}