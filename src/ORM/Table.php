<?php

namespace FrameworkDevA3\ORM;

use FrameworkDevA3\Utility\Str;

class Table
{
    protected $tableName;

    protected $entityName;

    public $entities = [];

    /**
     * @param string $name
     * @param array $arguments
     * @return $this
     */
    public function __call(string $name, array $arguments)
    {
        $db = Core::db();

        $data = [];
        // Split du name à toute les majuscules
        $arr = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);

        $entityClassName = Str::entityName($this->entityName, true);

        switch (count($arr)) {
            case 1:
                break;

            // getAll
            case 2:
                if ($arr[0] === 'get' && $arr[1] === 'All') {
                    $sth = $db->prepare("SELECT * FROM $this->tableName");
                    $sth->execute();
                    $data = $sth->fetchAll(\PDO::FETCH_CLASS, $entityClassName);
                }
                break;

            // getByField
            case 3:
                if ($arr[0] === 'get' && $arr[1] === 'By') {
                    $sth = $db->prepare("SELECT * FROM $this->tableName WHERE {$arr[2]} = '{$arguments[0]}'");
                    $sth->execute();
                    $data = $sth->fetchAll(\PDO::FETCH_CLASS, $entityClassName);
                }
                break;

            // getByFieldOrderBy
            case 5:
                if ($arr[0] === 'get' && $arr[1] === 'By' && $arr[3] === 'Order' && $arr[4] === 'By') {
                    $sth = $db->prepare("
                                    SELECT * 
                                    FROM $this->tableName 
                                    WHERE {$arr[2]} = '{$arguments[0]}'
                                    ORDER BY {$arguments[1]} {$arguments[2]}");
                    $sth->execute();
                    $data = $sth->fetchAll(\PDO::FETCH_CLASS, $entityClassName);
                }
                break;

            default:
                break;
        }
        $this->entities = $data;

        return $this;
    }
}
