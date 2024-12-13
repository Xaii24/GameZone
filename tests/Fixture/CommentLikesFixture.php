<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CommentLikesFixture
 */
class CommentLikesFixture extends TestFixture
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
            ],
        ];
        parent::init();
    }
}
