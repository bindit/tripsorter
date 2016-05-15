<?php

namespace Trip\Exception;

/**
 * Class NoFirstTransferFoundException
 */
class NoFirstTransferFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct("System is not able to define first transfer!");
    }
}