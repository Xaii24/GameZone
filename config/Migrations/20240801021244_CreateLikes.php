<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateLikes extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('likes');
        $table
            ->addColumn('article_id', 'integer', ['null' => false])
            ->addForeignKey('article_id', 'articles', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->create();
    }
}
