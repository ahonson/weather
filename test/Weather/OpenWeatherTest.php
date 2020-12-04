<?php

namespace artes\Weather;

use PHPUnit\Framework\TestCase;

/**
 * testing for IPGeotag
 * @SuppressWarnings(PHPMD)
 */
class OpenWeatherTest extends TestCase
{
    /**
    * OpenWeather
    */
    public function testCurrentweather()
    {
        $openweather = new OpenWeather("123345", "20", "45");
        $res = $openweather->currentweather();
        $this->assertIsArray($res);
    }

    /**
    * OpenWeather
    */
    public function testForecast()
    {
        $openweather = new OpenWeather("123345", "20", "45");
        $res = $openweather->forecast();
        $this->assertIsArray($res);
    }

    /**
    * OpenWeather
    */
    public function testHistoricweather()
    {
        $openweather = new OpenWeather("123345", "20", "45");
        $res = $openweather->historicweather();
        $this->assertIsArray($res);
    }
}
