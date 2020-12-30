<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InstructionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InstructionsTable Test Case
 */
class InstructionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InstructionsTable
     */
    public $Instructions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.instructions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Instructions') ? [] : ['className' => 'App\Model\Table\InstructionsTable'];
        $this->Instructions = TableRegistry::get('Instructions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Instructions);

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
