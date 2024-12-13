<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateLikesTable extends AbstractMigration
{
    public function change()
    {
        // Create the 'likes' table
        $table = $this->table('likes_table');
        $table
            ->addColumn('article_id', 'integer', ['null' => false])
            ->addColumn('user_id', 'integer', ['null' => false])
            ->addColumn('created', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addForeignKey('article_id', 'articles', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])
            ->create();
    }
}
