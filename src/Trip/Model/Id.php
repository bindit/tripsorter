<?php

namespace Trip\Model;

/**
 * Class Id
 */
trait Id
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}