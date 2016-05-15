<?php

namespace Trip\Factory;

/**
 * Interface FactoryInterface
 */
interface FactoryInterface
{
    /**
     * @param string $type
     * @param array $data
     */
    public function make($type, $data);
}