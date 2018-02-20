<?php

namespace vTraits;

use FrameworkDevA3\ORM\Core;

trait TableTrait
{
    public function getAll()
    {
        $db = Core::db();

        $query = $db->query('SELECT * FROM ' . $this->name . ';');

        $entities = [];

        $entityClassName = '\\App\\Entity\\'.ucfirst($this->name).'Entity';
        foreach ($query->fetchObject($entityClassName) as $entity) {
            $entities[] = $entity;
        }

        return $entities;
    }
}
