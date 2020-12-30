<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserdetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserdetailsTable Test Case
 */
class UserdetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserdetailsTable
     */
    public $Userdetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.userdetails',
        'app.locations',
        'app.provinces',
        'app.schools',
        'app.courses',
        'app.subjects',
        'app.questions',
        'app.schoollists'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Userdetails') ? [] : ['className' => 'App\Model\Table\UserdetailsTable'];
        $this->Userdetails = TableRegistry::get('Userdetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Userdetails);

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
