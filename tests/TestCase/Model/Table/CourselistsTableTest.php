<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourselistsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourselistsTable Test Case
 */
class CourselistsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourselistsTable
     */
    public $Courselists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.courselists',
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
        $config = TableRegistry::exists('Courselists') ? [] : ['className' => 'App\Model\Table\CourselistsTable'];
        $this->Courselists = TableRegistry::get('Courselists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Courselists);

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
