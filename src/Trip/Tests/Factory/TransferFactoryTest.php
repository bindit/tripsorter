<?php

namespace Trip\Tests\Factory;

use Trip\Factory\TransferFactory;
use Trip\Model\Place\Place;
use Trip\Model\Transfer\Bus;
use Trip\Model\Transfer\Flight;
use Trip\Model\Transfer\Train;
use Trip\Model\Transfer\TransferType;

/**
 * Class TransferFactoryTest
 */
class TransferFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TransferFactory
     */
    protected $factory;

    public function setUp()
    {
        $this->factory = new TransferFactory();
    }

    /**
     * @expectedException \Trip\Exception\WrongTransferTypeException
     */
    public function testWrongTransferTypeException()
    {
        $this->factory->make('wrongType', []);
    }

    public function testMakeBus()
    {
        $data = [
            'id' => 'AXZ',
            'seat' => null,
            'from' => 1,
            'to' => 2,
            'additional_info' => null
        ];

        /** @var Bus $bus */
        $bus = $this->factory->make(TransferType::BUS, $data);

        $this->assertInstanceOf(Bus::class, $bus);
        $this->assertSame($data['id'], $bus->getId());
        $this->assertSame($data['seat'], $bus->getSeat());
        $this->assertInstanceOf(Place::class, $bus->getFrom());
        $this->assertInstanceOf(Place::class, $bus->getTo());
        $this->assertSame($data['additional_info'], $bus->getAdditionalInfo());
    }

    public function testMakeTrain()
    {
        $data = [
            'id' => 'AXZ',
            'seat' => null,
            'from' => 1,
            'to' => 2,
            'additional_info' => null,
            'platform' => '3A'
        ];

        /** @var Train $train */
        $train = $this->factory->make(TransferType::TRAIN, $data);

        $this->assertInstanceOf(Train::class, $train);
        $this->assertSame($data['id'], $train->getId());
        $this->assertSame($data['seat'], $train->getSeat());
        $this->assertInstanceOf(Place::class, $train->getFrom());
        $this->assertInstanceOf(Place::class, $train->getTo());
        $this->assertSame($data['additional_info'], $train->getAdditionalInfo());
        $this->assertSame($data['platform'], $train->getPlatform());
    }

    public function testMakeFlight()
    {
        $data = [
            'id' => 'AXZ',
            'seat' => null,
            'from' => 1,
            'to' => 2,
            'additional_info' => null,
            'gate' => 52
        ];

        /** @var Flight $flight */
        $flight = $this->factory->make(TransferType::FLIGHT, $data);

        $this->assertInstanceOf(Flight::class, $flight);
        $this->assertSame($data['id'], $flight->getId());
        $this->assertSame($data['seat'], $flight->getSeat());
        $this->assertInstanceOf(Place::class, $flight->getFrom());
        $this->assertInstanceOf(Place::class, $flight->getTo());
        $this->assertSame($data['additional_info'], $flight->getAdditionalInfo());
        $this->assertSame($data['gate'], $flight->getGate());
    }
}