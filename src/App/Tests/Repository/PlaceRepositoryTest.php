<?php

namespace App\Tests\Repository;

use App\Repository\PlaceRepository;
use App\Data\Persistence\PersistenceInterface;
use Trip\Model\Place\Place;

/**
 * Class PlaceRepositoryTest
 */
class PlaceRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFind()
    {
        $persistence = $this
            ->getMockBuilder(PersistenceInterface::class)
            ->setMethods(['findAll'])
            ->getMock();

        $persistence
            ->expects($this->once())
            ->method('findAll')
            ->willReturn([
                [
                    'id' => 1,
                    'name' => 'Barcelona'
                ]
            ]);

        $repository = new PlaceRepository($persistence);
        $transfer = $repository->find(1);

        $this->assertInstanceOf(Place::class, $transfer);
    }

    /**
     * @expectedException \App\Exception\NoResultsFoundException
     */
    public function testNoResultsFoundException()
    {
        $persistence = $this
            ->getMockBuilder(PersistenceInterface::class)
            ->setMethods(['findAll'])
            ->getMock();

        $persistence
            ->expects($this->once())
            ->method('findAll')
            ->willReturn([
                ['id' => 3],['id' => 2]
            ]);

        $repository = new PlaceRepository($persistence);
        $repository->find(1);
    }
}