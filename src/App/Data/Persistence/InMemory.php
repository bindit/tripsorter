<?php

namespace App\Data\Persistence;

/**
 * Class InMemory
 */
class InMemory implements PersistenceInterface
{
    /**
     * @var array
     */
    protected $transfers = [
        [
            'id' => 'BC44212',
            'name' => '900L',
            'type' => 'bus',
            'from' => 1,
            'to' => 2,
            'seat' => null,
            'additional_info' => null
        ],
        [
            'id' => 'cbZ322',
            'name' => '54',
            'type' => 'bus',
            'from' => 4,
            'to' => 5,
            'seat' => null,
            'additional_info' => null
        ],
        [
            'id' => 'BC33212',
            'name' => 'IC Mieszko',
            'type' => 'train',
            'from' => 2,
            'to' => 4,
            'platform' => "2",
            'seat' => "33",
            'additional_info' => null
        ],
        [
            'id' => 'BC33412',
            'name' => 'TX10',
            'type' => 'flight',
            'gate' => '45B',
            'additional_info' => 'Baggage drop at ticket counter 344',
            'from' => 3,
            'to' => 1,
            'seat' => '010F'
        ],
        [
            'id' => 'zzz213',
            'name' => 'POLBUS',
            'type' => 'bus',
            'from' => 6,
            'to' => 3,
            'seat' => null,
            'additional_info' => null
        ]
    ];

    /**
     * @var array
     */
    protected $places = [
        [
            'id' => 1,
            'name' => 'Warszawa Airport'
        ],
        [
            'id' => 2,
            'name' => 'Warszawa Central'
        ],
        [
            'id' => 3,
            'name' => 'Wroclaw Airport'
        ],
        [
            'id' => 4,
            'name' => 'Bydgoszcz'
        ],
        [
            'id' => 5,
            'name' => 'Osiedle Lesne, Bydgoszcz'
        ],
        [
            'id' => 6,
            'name' => 'Trzebnica'
        ]
    ];

    /**
     * @param string $table
     * @return array
     */
    public function findAll($table)
    {
        $callable = 'get' . ucfirst($table);

        if (method_exists($this, $callable)) {
            return $this->$callable();
        }

        return $this->$table;
    }

    /**
     * @return array
     */
    public function getTransfer()
    {
        $transfers = [];
        foreach ($this->transfers as $transfer) {
            $id = $transfer['from'];
            $filteredFrom  = array_filter($this->places, function($place) use ($id) {
                return $place['id'] == $id;
            });

            $id = $transfer['to'];
            $filteredTo  = array_filter($this->places, function($place) use ($id) {
                return $place['id'] == $id;
            });

            $transfer['from'] = reset($filteredFrom);
            $transfer['to'] = reset($filteredTo);
            $transfers[] = $transfer;
        }

        return $transfers;
    }
}