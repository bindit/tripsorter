<?php

namespace Trip\Tests\Sorter;

use Trip\Model\Transfer\Transfer;
use Trip\Sorter\Sorter;
use Trip\Model\Transfer\TransferCollection;

/**
 * Class SorterTest
 */
class SorterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sorter
     */
    protected $sorter;

    public function setUp()
    {
        $this->sorter = new Sorter();
    }

    public function testSort()
    {
        $bus = $this
            ->getMockBuilder(Transfer::class)
            ->getMock();
        $flight = $this
            ->getMockBuilder(Transfer::class)
            ->getMock();
        $flight2 = $this
            ->getMockBuilder(Transfer::class)
            ->getMock();
        $train = $this
            ->getMockBuilder(Transfer::class)
            ->getMock();

        $bus
            ->method('getFrom')
            ->willReturn(1);

        $bus
            ->method('getTo')
            ->willReturn(2);

        $flight
            ->method('getFrom')
            ->willReturn(3);

        $flight
            ->method('getTo')
            ->willReturn(1);

        $flight2
            ->method('getFrom')
            ->willReturn(2);

        $flight2
            ->method('getTo')
            ->willReturn(4);

        $train
            ->method('getFrom')
            ->willReturn(4);

        $train
            ->method('getTo')
            ->willReturn(2);

        $toSort = new TransferCollection(
            [$train, $bus, $flight, $flight2]
        );

        $this->sorter->sort($toSort);

        $this->assertCount(4, $toSort);

        //test correct order
        $this->assertEquals($flight, $toSort->get(0));
        $this->assertEquals($bus, $toSort->get(1));
        $this->assertEquals($flight2, $toSort->get(2));
        $this->assertEquals($train, $toSort->get(3));
    }

    /**
     * @expectedException \Trip\Exception\MissingTransferException
     */
    public function testMissingTransferException()
    {
        $flight = $this->getMockBuilder(Transfer::class)
            ->getMock();

        $flight
            ->method('getFrom')
            ->willReturn(3);

        $flight
            ->method('getTo')
            ->willReturn(1);

        $bus = $this->getMockBuilder(Transfer::class)
            ->getMock();

        $bus
            ->method('getFrom')
            ->willReturn(2);

        $bus
            ->method('getTo')
            ->willReturn(4);

        $this->sorter->sort(new TransferCollection([$flight, $bus]));
    }

    /**
     * @expectedException \Trip\Exception\NoFirstTransferFoundException
     */
    public function testNoFirstTransferFoundException()
    {
        $flight = $this->getMockBuilder(Transfer::class)
            ->getMock();

        $flight2 = $this->getMockBuilder(Transfer::class)
            ->getMock();

        $flight
            ->method('getFrom')
            ->willReturn(3);

        $flight
            ->method('getTo')
            ->willReturn(1);

        $flight2
            ->method('getFrom')
            ->willReturn(1);

        $flight2
            ->method('getTo')
            ->willReturn(3);

        $this->sorter->sort(new TransferCollection([$flight, $flight2]));
    }
}