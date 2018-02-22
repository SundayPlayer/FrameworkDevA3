<?php

require_once '../../src/ORM/Core.php';

$db = FrameworkDevA3\ORM\Core::db();

$db->query("
    CREATE TABLE IF NOT EXISTS `_migrations` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `migration_name` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;
");