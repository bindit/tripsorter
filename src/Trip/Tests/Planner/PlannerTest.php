<?php

namespace Trip\Tests\Planner;

use Trip\Model\Transfer\Transfer;
use Trip\Model\Transfer\TransferCollection;
use Trip\Planner\Planner;
use Trip\Sorter\SorterInterface;

/**
 * Class PlannerTest
= */
class PlannerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Planner
     */
    protected $planner;

    public function setUp()
    {
        $sorter = $this
            ->getMockBuilder(SorterInterface::class)
            ->setMethods(['sort'])
            ->getMock();

        $sorter
            ->expects($this->once())
            ->method('sort');

        $this->planner = new Planner($sorter);
    }

    public function testPlan()
    {
        $transfers = $this
            ->getMockBuilder(TransferCollection::class)
            ->setMethods(['getTransfers'])
            ->getMock();

        $transfers
            ->expects($this->once())
            ->method('getTransfers')
            ->willReturn([
                $this->getMock(Transfer::class),
                $this->getMock(Transfer::class)
            ]);

        $this->planner->plan($transfers);

        $this->assertCount(3, $this->planner->getPlan());
        $this->assertSame("3. You have arrived at your final destination.", $this->planner->getPlan()[2]);
        $this->assertCount(3, $this->planner->jsonSerialize());
    }
}