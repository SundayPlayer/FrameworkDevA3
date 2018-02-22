<?php

require_once '../../src/Migration/BaseMigration.php';

use FrameworkDevA3\Migration\BaseMigration;

class CreatePostsTable extends BaseMigration
{
    public function up() {
        $this->path = __FILE__;

        $this->table('posts')
            ->addColumn('excerpt', 'string')
            ->addColumn('content', 'text')
            ->create();
    }
}