<?php

namespace Trip\Tests\Model\Transfer;

use Trip\Tests\GetAndSetTest;
use Trip\Model\Transfer\Train;

/**
 * Class TrainTest
 */
class TrainTest extends GetAndSetTest
{
    public function setUp()
    {
        $this->object = new Train();
    }
}