<?php

namespace Trip\Exception;

/**
 * Class WrongTransferTypeException
 */
class WrongTransferTypeException extends \Exception
{
    /**
     * @param string $type
     */
    public function __construct($type)
    {
        parent::__construct("Transfer type: '{$type}' do not exist!");
    }
}