<?php
namespace Access\Test\TestCase\View\Helper;

use Access\View\Helper\PermissionsHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * Access\View\Helper\PermissionsHelper Test Case
 */
class PermissionsHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Access\View\Helper\PermissionsHelper
     */
    public $Permissions;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Permissions = new PermissionsHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Permissions);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
