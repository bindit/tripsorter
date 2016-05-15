<?php

namespace Trip\Tests\Model\Transfer;

use Trip\Model\Transfer\TransferCollection;
use Trip\Model\Transfer\Transfer;

/**
 * Class TransferCollectionTest
 */
class TransferCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TransferCollection
     */
    protected $transferCollection;

    public function setUp()
    {
        $this->transferCollection = new TransferCollection();
    }

    public function testSetTransfers()
    {
        $transfers = [
            $this->getMock(Transfer::class),
            $this->getMock(Transfer::class),
            $this->getMock(Transfer::class)
        ];

        $this->transferCollection->setTransfers($transfers);

        $this->assertCount(3, $this->transferCollection);
    }

    public function testAddTransfer()
    {
        $this->transferCollection->addTransfer(
            $this->getMock(Transfer::class)
        );

        $this->assertCount(1, $this->transferCollection);
    }

    public function testGetTransfers()
    {
        $transfers = [
            $this->getMock(Transfer::class),
            $this->getMock(Transfer::class),
            $this->getMock(Transfer::class)
        ];

        $this->transferCollection->setTransfers($transfers);

        $this->assertCount(3, $this->transferCollection->getTransfers());
    }

    public function testGet()
    {
        $transfers = [
            $this->getMock(Transfer::class),
            $this->getMock(Transfer::class),
            $this->getMock(Transfer::class)
        ];

        $this->transferCollection->setTransfers($transfers);

        $this->assertEquals($transfers[1], $this->transferCollection->get(1));
    }
}