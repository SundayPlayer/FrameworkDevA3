<?php

namespace FrameworkDevA3\ORM;

use FrameworkDevA3\ORM\Traits\TableTrait;

class Table
{
    use TableTrait;

    private $name;

    private $entities;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Entity[]
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @param Entity[] $entities
     */
    public function setEntities($entities)
    {
        $this->entities = $entities;
    }
}
