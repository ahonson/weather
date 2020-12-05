<?php

namespace artes\Weather;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Testclass.
 */
class WeatherAPIControllerTest extends TestCase
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
        $controller = new WeatherAPIController();
        $controller->setDI($this->di);

        // Test the controller action
        $res = $controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "info".
     */
    public function testInfoActionGet()
    {
        // Setup the controller
        $controller = new WeatherAPIController();
        $controller->setDI($this->di);

        // Test the controller action
        $request = $this->di->get("request");
        $request->setGet("ip", "94.21.49.200");
        $request->setServer("REQUEST_METHOD", "GET");
        $res = $controller->infoActionGet();
        $request->setGet("type", "historical");
        $res1 = $controller->infoActionGet();
        $request->setGet("type", "forecast");
        $res2 = $controller->infoActionGet();
        $request->setServer("REQUEST_METHOD", "");
        $res3 = $controller->infoActionGet();
        $this->assertIsArray($res);
        $this->assertIsArray($res1);
        $this->assertIsArray($res2);
        $this->assertIsArray($res3);
    }

    /**
     * Test the route "info".
     */
    public function testInfoActionPost()
    {
        // Setup the controller
        $controller = new WeatherAPIController();
        $controller->setDI($this->di);

        // Test the controller action
        $request = $this->di->get("request");
        $request->setPost("userip", "94.21.49.200");
        $request->setServer("REQUEST_METHOD", "POST");
        $res = $controller->infoActionPost();
        $request->setPost("type", "historical");
        $res1 = $controller->infoActionPost();
        $request->setPost("type", "forecast");
        $res2 = $controller->infoActionPost();
        $request->setServer("REQUEST_METHOD", "");
        $res3 = $controller->infoActionPost();
        $this->assertIsArray($res);
        $this->assertIsArray($res1);
        $this->assertIsArray($res2);
        $this->assertIsArray($res3);
    }

    public function testGetWeather()
    {
        // Setup the controller
        $controller = new WeatherAPIController();
        $controller->setDI($this->di);
        // Test the controller action
        $res = $controller->getWeather("345", "20", "45", "historical");
        $res1 = $controller->getWeather("345", "20", "45", "forecast");
        $res2 = $controller->getWeather("345", "20", "45", "");
        $this->assertIsArray($res);
        $this->assertIsArray($res1);
        $this->assertIsArray($res2);
    }
}
