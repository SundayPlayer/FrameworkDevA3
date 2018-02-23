<?php

namespace FrameworkDevA3\Migration;

use FrameworkDevA3\ORM\Core;

class BaseMigration
{
    protected $sql = '';
    protected $table = [];

    public $path = '';

    public function table(string $tableName, string $engine = 'innoDB')
    {
        $this->table['tableName'] = $tableName;
        $this->table['engine'] = $engine;

        $this->addColumn('id', 'integer', 'NOT NULL AUTO_INCREMENT')
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->addPrimaryKeys(['id']);

        return $this;
    }

    public function addColumn(string $columnName, string $type, string $param = 'NOT NULL')
    {
        $validType = '';

        switch ($type) {
            case 'integer':
                $validType = 'INT';
                break;

            case 'string':
                $validType = 'VARCHAR(255)';
                break;

            case 'text':
                $validType = 'TEXT';
                break;

            case 'timestamp':
                $validType = 'TIMESTAMP';
                break;
        }

        $this->table['columns'][] = [
            'column_name' => $columnName,
            'type' => $validType,
            'param' => $param
        ];

        return $this;
    }

    public function addPrimaryKeys(array $keys)
    {
        $this->table['primaryKeys'] = $keys;
    }

    public function addForeignKey(string $column, string $referencedTable, string $referencedColumn, array $action = [])
    {
        $this->table['foreignKeys'][] = [
            'column' => $column,
            'referencedTable' => $referencedTable,
            'referencedColumn' => $referencedColumn,
            'action' => $action
        ];

        return $this;
    }

    public function create()
    {
        $this->sql .= "CREATE TABLE IF NOT EXISTS `{$this->table['tableName']}` (";

        foreach ($this->table['columns'] as $column) {
            $this->sql .= " `{$column['column_name']}` {$column['type']} {$column['param']}, ";
        }

        if (isset($this->table['primaryKeys'])) {
            $this->sql .= 'PRIMARY KEY(';
            // Add primary keys
            foreach ($this->table['primaryKeys'] as $key) {
                $this->sql .= '`' . $key . '` ,';
            }
            // delete last ' ,'
            $this->sql = substr_replace($this->sql, '', -2, 2);
            $this->sql .= ')';
        } else {
            // delete last ' ,'
            $this->sql = substr_replace($this->sql, '', -2, 2);
        }

        if (isset($this->table['foreignKeys'])) {
            foreach ($this->table['foreignKeys'] as $foreignKey) {
                $this->sql .= ", INDEX `fk_{$this->table['tableName']}_{$foreignKey['referencedTable']}_idx` (`{$foreignKey['column']}` ASC), ";
                $this->sql .= "CONSTRAINT `fk_{$this->table['tableName']}_{$foreignKey['referencedTable']}`";
                $this->sql .= " FOREIGN KEY (`{$foreignKey['column']}`)";
                $this->sql .= " REFERENCES `{$foreignKey['referencedTable']}` (`{$foreignKey['referencedColumn']}`)";
                if (isset($foreignKey['action'])) {
                    $this->sql .= " ON DELETE {$foreignKey['action']['delete']}";
                    $this->sql .= " ON UPDATE {$foreignKey['action']['update']}";
                } else {
                    $this->sql .= " ON DELETE NO ACTION";
                    $this->sql .= " ON UPDATE NO ACTION";
                }
            }
        }

        $this->sql .= ") ENGINE = {$this->table['engine']}; ";
        unset($this->table);

        return $this;
    }

    public function exec()
    {
        $db = Core::db();

        if ($this->hasTable('_migrations')) {
            $sth = $db->prepare("
                SELECT *
                FROM _migrations
                WHERE migration_name = :filename
            ");
            $sth->execute([
                'filename' => basename($this->path, '.php')
            ]);
            $isMigrated = $sth->fetch();

            if (!$isMigrated) {
                $db->query($this->sql);
                $sth = $db->prepare("
                  INSERT INTO _migrations (migration_name)
                  VALUES (:filename)
                ");
                $sth->execute([
                    'filename' => basename($this->path, '.php')
                ]);
            } else {
                exit('Nothing to do, migration already done!');
            }
        } else {
            // Exception : table migrations doesnt exists -> php initMigration.php
            exit('table `migrations` doesnt exist -> php initMigration.php');
        }
    }

    public function hasTable(string $tableName)
    {
        $db = Core::db();
        $sth = $db->prepare(
            "SELECT *
            FROM information_schema.TABLES
            WHERE TABLE_NAME = :tableName"
        );
        $sth->execute(['tableName' => $tableName]);
        $hasTable = $sth->fetch();

        if ($hasTable) {
            return true;
        } else {
            return false;
        }
    }

    public function getDump()
    {
        return $this->table;
    }

    public function getSql()
    {
        return $this->sql;
    }

    public function dd($fuck)
    {
        echo '<pre>';
        var_dump($fuck);
        echo '</pre>';
        // exit;
    }
}
