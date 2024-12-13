<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LikesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LikesTable Test Case
 */
class LikesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LikesTable
     */
    protected $Likes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Likes',
        'app.Articles',
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
        $config = $this->getTableLocator()->exists('Likes') ? [] : ['className' => LikesTable::class];
        $this->Likes = $this->getTableLocator()->get('Likes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Likes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LikesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LikesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
