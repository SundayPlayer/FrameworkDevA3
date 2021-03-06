<?php

namespace FrameworkDevA3\ORM;

use PDO;

class Core
{
    private $db;

    private static $_instance;

    public static function db()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Core();
        }
        return self::$_instance->db;
    }

    private function __construct()
    {
        $conf = include __DIR__ . '/../../app/config.php';

        $this->db = new PDO(
            'mysql:host=' . $conf['ORM']['database']['host']
                . ';port=' . $conf['ORM']['database']['port']
                . ';dbname=' . $conf['ORM']['database']['name'],
            $conf['ORM']['database']['username'],
            $conf['ORM']['database']['password']
        );
    }
}
