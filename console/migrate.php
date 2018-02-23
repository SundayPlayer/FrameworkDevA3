<?php
require_once '../vendor/autoload.php';
ini_set('display_errors', 1);

$className = '';

foreach (glob(__DIR__."/../app/Db/migrations/*.php") as $filename) {
    require_once $filename;

    $arr = preg_split('/_/', basename($filename, '.php'), -1, PREG_SPLIT_NO_EMPTY);

    for ($i = 1; $i < count($arr); $i++) {
        $className .= ucfirst($arr[$i]);
    }

    $tableToMigrate = new $className;

    $tableToMigrate->up($filename);
}