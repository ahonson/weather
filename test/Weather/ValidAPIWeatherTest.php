<?php

namespace artes\Weather;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
  * A class for validating weather parameters.
  *
  * @SuppressWarnings(PHPMD)
  */
class ValidAPIWeatherTest extends TestCase
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

    public function testErrormsg()
    {
        $ip = $this->di->get("ip");
        $request = $this->di->get("request");
        $request->setServer("REQUEST_METHOD", "POST");
        $request->setPost("userip", "345.45.345.4");
        $request->setPost("longitud", "345.45");
        $request->setPost("latitud", "345.45");
        $vw = new ValidAPIWeather($request, $ip);
        $res = $vw->errormsg();
        $this->assertIsString($res);
    }

    public function testErrormsg1()
    {
        $ip = $this->di->get("ip");
        $request = $this->di->get("request");
        $request->setServer("REQUEST_METHOD", "POST");
        $request->setPost("userip", "345.45.345.4");
        $request->setPost("longitud", "45.45");
        $request->setPost("latitud", "45.45");
        $vw = new ValidAPIWeather($request, $ip);
        $res = $vw->errormsg();
        $this->assertIsString($res);
    }

    public function testErrormsg2()
    {
        $ip = $this->di->get("ip");
        $request = $this->di->get("request");
        $request->setGet("ipadress", "yes");
        $request->setGet("userip", "456.56.56.5");
        $vw = new ValidAPIWeather($request, $ip);
        $res = $vw->errormsg();
        $this->assertIsString($res);
    }

    public function testErrormsg3()
    {
        $ip = $this->di->get("ip");
        $request = $this->di->get("request");
        $request->setServer("REQUEST_METHOD", "GET");
        $request->setGet("ipadress", "yes");
        $request->setGet("userip", "456.56.56.5");
        $vw = new ValidAPIWeather($request, $ip);
        $res = $vw->errormsg();
        $this->assertIsString($res);
    }
}
