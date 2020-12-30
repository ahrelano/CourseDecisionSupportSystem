<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HistorychoicesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HistorychoicesTable Test Case
 */
class HistorychoicesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HistorychoicesTable
     */
    public $Historychoices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.historychoices',
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
        'app.scorelists'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Historychoices') ? [] : ['className' => 'App\Model\Table\HistorychoicesTable'];
        $this->Historychoices = TableRegistry::get('Historychoices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Historychoices);

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
