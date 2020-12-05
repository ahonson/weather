<?php

namespace artes\Weather;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Testclass.
 */
class WeatherControllerTest extends TestCase
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
        $controller = new WeatherController();
        $controller->setDI($this->di);

        // Test the controller action
        $res = $controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "index".
     */
    public function testIndexActionPost()
    {
        // Setup the controller
        $controller = new WeatherController();
        $controller->setDI($this->di);

        // Test the controller action
        $request = $this->di->get("request");
        $request->setPost("userip", "8.8.8.8");
        $res = $controller->indexActionPost();
        $request->setPost("infotyp", "historik");
        $res1 = $controller->indexActionPost();
        $request->setPost("longitud", "null");
        $request->setPost("koordinater", "null");
        $res2 = $controller->indexActionPost();
        // $body = $res->getBody();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $this->assertInstanceOf(ResponseUtility::class, $res1);
        $this->assertInstanceOf(ResponseUtility::class, $res2);
    }

    public function testGetWeather()
    {
        // Setup the controller
        $controller = new WeatherController();
        $controller->setDI($this->di);
        // Test the controller action
        $res = $controller->getWeather("345", "20", "45", "historik");
        $res1 = $controller->getWeather("345", "20", "45", "");
        $this->assertIsArray($res);
        $this->assertIsArray($res1);
    }
}
