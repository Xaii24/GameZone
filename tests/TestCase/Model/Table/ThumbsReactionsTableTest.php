<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ThumbsReactionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ThumbsReactionsTable Test Case
 */
class ThumbsReactionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ThumbsReactionsTable
     */
    protected $ThumbsReactions;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.ThumbsReactions',
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
        $config = $this->getTableLocator()->exists('ThumbsReactions') ? [] : ['className' => ThumbsReactionsTable::class];
        $this->ThumbsReactions = $this->getTableLocator()->get('ThumbsReactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ThumbsReactions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ThumbsReactionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ThumbsReactionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
