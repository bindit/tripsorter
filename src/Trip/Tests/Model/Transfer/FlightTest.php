<?php

namespace Trip\Tests\Model\Transfer;

use Trip\Tests\GetAndSetTest;
use Trip\Model\Transfer\Flight;

/**
 * Class FlightTest
 */
class FlightTest extends GetAndSetTest
{
    public function setUp()
    {
        $this->object = new Flight();
    }
}