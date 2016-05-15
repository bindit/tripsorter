<?php

namespace App\Serializer;

use App\Exception\InvalidJsonException;

/**
 * Class JsonSerializer
 */
class JsonSerializer
{
    /**
     * @param $data
     * @return string
     */
    public function serialize($data)
    {
        if (is_object($data) && !$data instanceof \JsonSerializable) {
            throw new \InvalidArgumentException(get_class($data) . " does not implement \JsonSerializable");
        }

        return json_encode($data);
    }

    /**
     * @param string $data
     * @return array
     * @throws InvalidJsonException
     */
    public function deserialize($data)
    {
        $deserialized = json_decode($data, true);

        if (!$deserialized) {
            throw new InvalidJsonException();
        }

        return $deserialized;
    }
}