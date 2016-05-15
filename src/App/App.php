<?php

namespace App;

use App\Data\Persistence\InMemory;
use App\Repository\PlaceRepository;
use App\Repository\TransferRepository;
use App\Serializer\JsonSerializer;
use Trip\Planner\Planner;
use Trip\Factory\TransferFactory;
use Trip\Model\Transfer\TransferCollection;
use Trip\Sorter\Sorter;

class App
{
    /**
     * @var array
     */
    protected $repositories = [];

    /**
     * @var array
     */
    protected $services = [];

    public function __construct()
    {
        $this->repositories['transfer'] = new TransferRepository(
            new InMemory(),
            new TransferFactory()
        );

        $this->repositories['place'] = new PlaceRepository(
            new InMemory()
        );

        $this->services['trip_planner'] = new Planner(new Sorter());
        $this->services['json_serializer'] = new JsonSerializer();
    }

    /**
     * @param string $jsonBoardingCardsNumbers
     * @return string
     */
    public function printTrip($jsonBoardingCardsNumbers)
    {
        try {
            $boardingCardsNumbers = $this->services['json_serializer']
                ->deserialize($jsonBoardingCardsNumbers);

            $transfers = new TransferCollection();
            foreach ($boardingCardsNumbers as $number) {
                $transfers->addTransfer(
                    $this->repositories['transfer']->find($number)
                );
            }

            $this->services['trip_planner']->plan($transfers);
        } catch (\Exception $e) {
            return $this->services['json_serializer']
                ->serialize($e->getMessage());
        }

        return $this->services['json_serializer']
            ->serialize($this->services['trip_planner']);
    }
}