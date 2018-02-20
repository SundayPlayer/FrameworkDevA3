<?php

namespace FrameworkDevA3\ORM;

use FrameworkDevA3\ORM\Traits\EntityTrait;

class Entity
{
    use EntityTrait;

    private $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
