<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ThumbsReactionsFixture
 */
class ThumbsReactionsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'comment_id' => 1,
                'user_id' => 1,
                'reaction_type' => 'Lorem ipsum dolor sit amet',
                'created' => 1723104592,
                'modified' => 1723104592,
            ],
        ];
        parent::init();
    }
}
