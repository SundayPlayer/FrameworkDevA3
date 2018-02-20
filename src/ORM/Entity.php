<?php

namespace FrameworkDevA3\ORM;

use ArrayIterator;
use FrameworkDevA3\ORM\Core;
use FrameworkDevA3\ORM\Traits\EntityTrait;

class Entity
{
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


    public function save()
    {
        if (!isset($this->id)) {
            $db = Core::db();
            $data = new ArrayIterator($this->data);

            $values = "";
            foreach ($data as $key => $value) {
                $values .= $value;
                if ($data->hasNext()) {
                    $values .= ", ";
                }
            }
            $query = $db->query("INSERT INTO " . $this->name . " VALUES (" . $values . ")");
            $query->fetch();
        } else {
            $db = Core::db();
            $data = new ArrayIterator($this->data);

            $values = "";
            foreach ($data as $key => $value) {
                $values .= $key . " = " . $value;
                if ($data->hasNext()) {
                    $values .= ", ";
                }
            }
            $query = $db->query("UPDATE " . $this->name . "SET " . $data . " WHERE id=" . $this->id);
            $query->fetch();
        }
    }

    public function delete()
    {
        $db = Core::db();
        $query = $db->query("DELETE FROM " . $this->name . " WHERE id=" . $this->id);
        $query->fetch();
    }
}
