<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddLikesCountToArticles extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('articles');
        $table
            ->addColumn('likes_count', 'integer', [
                'default' => 0,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {
        $table = $this->table('articles');
        $table->removeColumn('likes_count')->update();
    }
}
