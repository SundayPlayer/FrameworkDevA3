<?php

namespace FrameworkDevA3\ORM\Traits;

use ArrayIterator;
use FrameworkDevA3\ORM\Core;

trait EntityTrait
{
    /*public function save()
    {
        $db = Core::db();
        $data = new ArrayIterator($this->data);

        $values="";
        foreach ($data as $key => $value){
            $values.=$value;
            if($data->hasNext()){
                $values.=", ";
            }
        }
        $query = $db->query("INSERT INTO ".$this->name." VALUES (".$values.")");

        $values="";
        foreach ($data as $key => $value){
            $values.=$key." = ".$value;
            if($data->hasNext()){
                $values.=", ";
            }
        }
        $query = $db->query("UPDATE ".$this->name."SET ".$data." WHERE id=".$this->id);
    }*/

    public function create()
    {
        $db = Core::db();
        $data = new ArrayIterator($this->data);

        $values="";
        foreach ($data as $key => $value) {
            $values.=$value;
            if ($data->hasNext()) {
                $values.=", ";
            }
        }
        $query = $db->query("INSERT INTO ".$this->name." VALUES (".$values.")");
    }

    public function update()
    {
        $db = Core::db();
        $data = new ArrayIterator($this->data);

        $values="";
        foreach ($data as $key => $value) {
            $values.=$key." = ".$value;
            if ($data->hasNext()) {
                $values.=", ";
            }
        }
        $query = $db->query("UPDATE ".$this->name."SET ".$data." WHERE id=".$this->id);
    }

    public function delete()
    {
        $db = Core::db();
        $query = $db->query("DELETE FROM ". $this->name." WHERE id=".$this->id);
    }
}
