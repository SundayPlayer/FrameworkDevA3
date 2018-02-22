<?php

namespace FrameworkDevA3\ORM;

use ArrayIterator;

class Entity
{
    protected $data;

    protected $tableName;

    public function __get($name)
    {
//        var_dump($name);die;
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @return mixed
     */
    public function values($data = null)
    {
        if (is_null($data)) {
            return $this->data;
        } else {
            $this->data = $data;
        }
    }

    /**
     *
     *
     */
    public function save()
    {
        $db = Core::db();
        if (!isset($this->data['id'])) {
            $data = new \CachingIterator(new ArrayIterator($this->data));

            $values = "";
            $column = "";
            foreach ($data as $key => $value) {
                if (gettype($value) == 'string') {
                    $value = "'" . $value . "'";
                }
                $values .= $value;
                $column .= $key;
                if ($data->hasNext()) {
                    $values .= ", ";
                    $column .= ", ";
                }
            }
            $query = $db->query("INSERT INTO " . $this->tableName . ' (' . $column . ") VALUES (" . $values . ");");
            return $query->execute();
        } else {
            $data = new \CachingIterator(new ArrayIterator($this->data));

            $values = "";
            foreach ($data as $key => $value) {
                if (gettype($value) == 'string') {
                    $value = "'" . $value . "'";
                }
                $values .= $key . " = " . $value;
                if ($data->hasNext()) {
                    $values .= ", ";
                }
            }
            echo "UPDATE " . $this->tableName . " SET " . $values . " WHERE id=" . $this->id . ";";
            $query = $db->query("UPDATE " . $this->tableName . " SET " . $values . " WHERE id=" . $this->id . ";");
            return $query->execute();
        }
    }

    public function delete()
    {
        $db = Core::db();
        $query = $db->query("DELETE FROM " . $this->tableName . " WHERE id=" . $this->id . ";");
        return $query->execute();
    }
}
