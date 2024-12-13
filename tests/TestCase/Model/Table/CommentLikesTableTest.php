<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommentLikesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommentLikesTable Test Case
 */
class CommentLikesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CommentLikesTable
     */
    protected $CommentLikes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.CommentLikes',
        'app.Comments',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CommentLikes') ? [] : ['className' => CommentLikesTable::class];
        $this->CommentLikes = $this->getTableLocator()->get('CommentLikes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CommentLikes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CommentLikesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CommentLikesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
