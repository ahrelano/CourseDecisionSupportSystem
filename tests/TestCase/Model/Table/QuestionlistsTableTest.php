<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuestionlistsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuestionlistsTable Test Case
 */
class QuestionlistsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuestionlistsTable
     */
    public $Questionlists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.questionlists',
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
        $config = TableRegistry::exists('Questionlists') ? [] : ['className' => 'App\Model\Table\QuestionlistsTable'];
        $this->Questionlists = TableRegistry::get('Questionlists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Questionlists);

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
