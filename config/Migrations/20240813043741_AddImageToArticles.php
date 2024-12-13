<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddImageToArticles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('articles');

        // Check if the column 'image' already exists
        if (!$table->hasColumn('image')) {
            $table->addColumn('image', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ]);
        }

        $table->update();
    }
}
