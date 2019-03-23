<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SaquesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SaquesTable Test Case
 */
class SaquesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SaquesTable
     */
    public $Saques;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.saques',
        'app.banks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Saques') ? [] : ['className' => SaquesTable::class];
        $this->Saques = TableRegistry::getTableLocator()->get('Saques', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Saques);

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
