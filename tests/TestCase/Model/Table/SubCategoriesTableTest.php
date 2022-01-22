<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubCategoriesTable Test Case
 */
class SubCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SubCategoriesTable
     */
    public $SubCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SubCategories',
        'app.Categories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SubCategories') ? [] : ['className' => SubCategoriesTable::class];
        $this->SubCategories = TableRegistry::getTableLocator()->get('SubCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SubCategories);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
