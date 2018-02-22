<?php

require_once '../../src/Migration/BaseMigration.php';

use FrameworkDevA3\Migration\BaseMigration;

class CreateSampleTable extends BaseMigration
{
    public function up() {
        $this->path = __FILE__;

        $this->table('tableName')
            ->addColumn('columnName', 'string')
            ->addColumn('columnName', 'text')
            ->create();
    }
}