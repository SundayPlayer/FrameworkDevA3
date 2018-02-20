<?php

namespace FrameworkDevA3\ORM\Traits;

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

    public function __call(string $name, array $arguments)
    {
        $data = [];
        // Split du name à toute les majuscules
        $arr = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);
    }
}
