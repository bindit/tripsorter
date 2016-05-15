<?php

namespace Trip\Factory;

use Trip\Exception\WrongTransferTypeException;
use Trip\Model\Place\Place;
use Trip\Model\Transfer\Flight;
use Trip\Model\Transfer\Train;
use Trip\Model\Transfer\Transfer;
use Trip\Model\Transfer\TransferType;
use Trip\Model\Transfer\Bus;

/**
 * Class TransferFactory
 */
class TransferFactory implements FactoryInterface
{
    /**
     * @var array
     */
    protected $transfers = [
        TransferType::BUS => Bus::class,
        TransferType::FLIGHT => Flight::class,
        TransferType::TRAIN => Train::class
    ];

    /**
     * @param $type
     * @param $data
     * @return Transfer
     * @throws WrongTransferTypeException
     */
    public function make($type, $data)
    {
        if (!isset($this->transfers[$type])) {
            throw new WrongTransferTypeException($type);
        }

        $callable = 'make' . ucfirst($type);

        /** @var Transfer $transfer */
        if (method_exists($this, $callable)) {
            $transfer = $this->$callable($data);
        } else {
            $transfer = new $this->transfers[$type]($data);
        }

        $transfer->setId($data['id']);
        $transfer->setFrom($this->makePlace($data['from']));
        $transfer->setTo($this->makePlace($data['to']));
        $transfer->setSeat($data['seat']);
        $transfer->setAdditionalInfo($data['additional_info']);

        return $transfer;
    }

    /**
     * @param array $data
     * @return Train
     */
    protected function makeTrain($data)
    {
        $train = new Train();
        $train->setPlatform($data['platform']);

        return $train;
    }

    /**
     * @param array $data
     * @return Flight
     */
    protected function makeFlight($data)
    {
        $flight = new Flight();
        $flight->setGate($data['gate']);

        return $flight;
    }

    /**
     * @param array $data
     * @return Place
     */
    protected function makePlace($data)
    {
        return new Place($data['id'], $data['name']);
    }
}