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
class ValidWeatherTest extends TestCase
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
        $request->setPost("ipadress", "yes");
        $validweather = new ValidWeather($request, $ip);
        $res = $validweather->errormsg();
        $this->assertIsString($res);
    }

    public function testErrormsg1()
    {
        $ip = $this->di->get("ip");
        $request = $this->di->get("request");
        $request->setPost("koordinater", "yes");
        $request->setPost("latitud", "25");
        $request->setPost("longitud", "47");
        $validweather = new ValidWeather($request, $ip);
        $res = $validweather->errormsg();
        $this->assertIsString($res);
    }

    public function testErrormsg2()
    {
        $ip = $this->di->get("ip");
        $request = $this->di->get("request");
        $request->setPost("ipadress", "yes");
        $request->setPost("userip", "456.56.56.5");
        $validweather = new ValidWeather($request, $ip);
        $res = $validweather->errormsg();
        $this->assertIsString($res);
    }

    public function testErrormsg3()
    {
        $ip = $this->di->get("ip");
        $request = $this->di->get("request");
        $request->setPost("koordinater", "yes");
        $request->setPost("latitud", "225");
        $request->setPost("longitud", "547");
        $validweather = new ValidWeather($request, $ip);
        $res = $validweather->errormsg();
        $this->assertIsString($res);
    }

    public function testErrormsg4()
    {
        $ip = $this->di->get("ip");
        $request = $this->di->get("request");
        $request->setPost("koordinater", "yes");
        $request->setPost("latitud", "");
        $request->setPost("longitud", "547");
        $validweather = new ValidWeather($request, $ip);
        $res = $validweather->errormsg();
        $this->assertIsString($res);
    }
}
