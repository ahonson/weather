<?php

namespace artes\IP;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Testclass.
 */
class IPControllerTest extends TestCase
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
        $controller = new IPController();
        $controller->setDI($this->di);

        // Test the controller action
        $res = $controller->indexActionGet();
        $session = $this->di->get("session");
        $session->set("userip", "8.8.8.8");
        $res2 = $controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $this->assertInstanceOf(ResponseUtility::class, $res2);
    }

    /**
     * Test the route "index".
     */
    public function testIndexActionPost()
    {
        // Setup the controller
        $controller = new IPController();
        $controller->setDI($this->di);

        // Test the controller action
        $res = $controller->indexActionPost();
        // $body = $res->getBody();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "init".
     */
    public function testInitAction()
    {
        // Setup the controller
        $controller = new IPController();
        $controller->setDI($this->di);

        // Test the controller action
        $res = $controller->initAction();
        // $body = $res->getBody();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
