<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SchoollistsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SchoollistsTable Test Case
 */
class SchoollistsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SchoollistsTable
     */
    public $Schoollists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.schoollists',
        'app.userdetails',
        'app.schools',
        'app.locations',
        'app.provinces'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Schoollists') ? [] : ['className' => 'App\Model\Table\SchoollistsTable'];
        $this->Schoollists = TableRegistry::get('Schoollists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Schoollists);

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
