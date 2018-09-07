<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormPaymentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormPaymentsTable Test Case
 */
class FormPaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormPaymentsTable
     */
    public $FormPayments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.form_payments',
        'app.values'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FormPayments') ? [] : ['className' => FormPaymentsTable::class];
        $this->FormPayments = TableRegistry::getTableLocator()->get('FormPayments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormPayments);

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
}
