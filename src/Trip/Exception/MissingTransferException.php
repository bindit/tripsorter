<?php

namespace Trip\Exception;

/**
 * Class MissingTransferException
 */
class MissingTransferException extends \Exception
{
    public function __construct()
    {
        parent::__construct("System is not able to define next transfer!");
    }
}