<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HistoryquestionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HistoryquestionsTable Test Case
 */
class HistoryquestionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HistoryquestionsTable
     */
    public $Historyquestions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.historyquestions',
        'app.users',
        'app.locations',
        'app.schools',
        'app.questions',
        'app.subjects',
        'app.choices',
        'app.questionlists',
        'app.userdetails',
        'app.courses',
        'app.courselists',
        'app.schoollists',
        'app.scorelists',
        'app.historychoices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Historyquestions') ? [] : ['className' => 'App\Model\Table\HistoryquestionsTable'];
        $this->Historyquestions = TableRegistry::get('Historyquestions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Historyquestions);

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
