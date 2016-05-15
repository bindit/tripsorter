<?php

namespace App\Exception;

/**
 * Class InvalidJsonException
 */
class InvalidJsonException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Provided argument is not a valid JSON");
    }
}