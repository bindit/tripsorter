<?php

namespace App\Tests\Repository;

use App\Repository\TransferRepository;
use App\Data\Persistence\PersistenceInterface;
use Trip\Factory\FactoryInterface;
use Trip\Model\Transfer\Transfer;
use Trip\Model\Transfer\TransferCollection;
use Trip\Model\Transfer\TransferType;

/**
 * Class TransferRepositoryTest
 */
class TransferRepositoryTest extends \PHPUnit_Framework_TestCase
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
                    'type' => TransferType::BUS
                ]
            ]);

        $factory = $this
            ->getMockBuilder(FactoryInterface::class)
            ->setMethods(['make'])
            ->getMock();

        $factory
            ->expects($this->once())
            ->method('make')
            ->willReturn($this->getMock(Transfer::class));

        $repository = new TransferRepository($persistence, $factory);
        $transfer = $repository->find(1);

        $this->assertInstanceOf(Transfer::class, $transfer);
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
                [
                    'id' => 3,
                    'type' => TransferType::BUS
                ],
                [
                    'id' => 2,
                    'type' => TransferType::FLIGHT
                ]
            ]);

        $factory = $this
            ->getMockBuilder(FactoryInterface::class)
            ->setMethods(['make'])
            ->getMock();

        $factory
            ->expects($this->any())
            ->method('make');

        $repository = new TransferRepository($persistence, $factory);
        $repository->find(1);
    }
}