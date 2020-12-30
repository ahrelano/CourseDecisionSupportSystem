<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScorelistsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScorelistsTable Test Case
 */
class ScorelistsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ScorelistsTable
     */
    public $Scorelists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.scorelists',
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
        $config = TableRegistry::exists('Scorelists') ? [] : ['className' => 'App\Model\Table\ScorelistsTable'];
        $this->Scorelists = TableRegistry::get('Scorelists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Scorelists);

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
