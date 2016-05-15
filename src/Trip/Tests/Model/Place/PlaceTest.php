<?php

namespace Trip\Tests\Model\Place;

use Trip\Model\Place\Place;
use Trip\Tests\GetAndSetTest;

/**
 * Class PlaceTest
 */
class PlaceTest extends GetAndSetTest
{
    public function setUp()
    {
        $this->object = new Place(1, 'name');
    }

    public function testPlaceConstructor()
    {
        $this->assertSame(1, $this->object->getId());
        $this->assertSame('name', $this->object->getName());

    }
}