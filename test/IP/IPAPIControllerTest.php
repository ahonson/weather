<?php

namespace artes\IP;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

// define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/.."));
/**
 * Testclass.
 */
class IPAPIControllerTest extends TestCase
{
    // Create the di container.
    protected $di;

    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->di = $di;
    }

    /**
     * Test the route "index".
     */
    public function testIndexActionGet()
    {
        // Setup the controller
        $controller = new IPAPIController();
        $controller->setDI($this->di);

        // Test the controller action
        $res = $controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "check".
     */
    public function testCheckActionGet()
    {
        // Setup the controller
        $controller = new IPAPIController();
        $controller->setDI($this->di);

        // Test the controller action
        $request = $this->di->get("request");
        $request->setGet("ip", "94.21.49.200");
        $res = $controller->checkActionGet();
        $this->assertIsArray($res);
    }

    /**
     * Test the route "check".
     */
    public function testCheckActionPost()
    {
        // Setup the controller
        $controller = new IPAPIController();
        $controller->setDI($this->di);

        // Test the controller action
        $request = $this->di->get("request");
        $request->setPost("ip", "94.21.49.200");
        $res = $controller->checkActionPost();
        $this->assertIsArray($res);
    }
}
