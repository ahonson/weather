<?php

namespace artes\IP;

use PHPUnit\Framework\TestCase;

/**
 * testing for IPGeotag
 * @SuppressWarnings(PHPMD)
 */
class IPGeotagTest extends TestCase
{
    /**
     * IPGeotag
     */
    public function testGetmap()
    {
        $ipkey = "78956734565756767868";
        $geoip = new IPGeotagMock($ipkey);
        $res = $geoip->getmap("8.8.8.8");
        $this->assertIsString($res);
    }

    /**
     * IPGeotag
     */
    public function testPrintmap()
    {
        $ipkey = "78956734565756767868";
        $geoip = new IPGeotagMock($ipkey);
        $res = $geoip->printmap("34.5", "19.5");
        $this->assertIsString($res);
    }


    /**
     * IPGeotag
     */
    public function testcheckuserip()
    {
        $ipkey = "78956734565756767868";
        $geoip = new IPGeotagMock($ipkey);
        $res = $geoip->checkuserip();
        $this->assertIsArray($res);
    }

    /**
     * IPGeotag
     */
    public function testparseJson()
    {
        $ipkey = "78956734565756767868";
        $geoip = new IPGeotagMock($ipkey);
        $res = $geoip->parseJson("94.21.49.200", "location", "capital");
        $geoip1 = new IPGeotagMock($ipkey);
        $res1 = $geoip1->parseJson("94.21.49.200", "location", "capital", "name");
        $geoip2 = new IPGeotagMock($ipkey);
        $res2 = $geoip2->parseJson("94.21.49.200", "location");
        $this->assertIsString($res);
        $this->assertIsString($res1);
        $this->assertIsString($res2);
    }

    /**
     * IPGeotag
     */
    public function testcheckinputip()
    {
        $ipkey = "78956734565756767868";
        $geoip = new IPGeotagMock($ipkey);
        $res = $geoip->checkinputip("");
        $geoip1 = new IPGeotagMock($ipkey);
        $res1 = $geoip1->checkinputip("8.8.8.8");
        $this->assertIsString($res);
        $this->assertIsString($res1);
    }

    /**
     * IPGeotag
     */
    public function testPrintGeoDetails()
    {
        $ipkey = "78956734565756767868";
        $geoip = new IPGeotagMock($ipkey);
        $myjson = [
            "continent_name" => "Europe",
            "country_name" => "France",
            "country_code" => "1234",
            "city" => "Paris",
            "zip" => "12345",
            "latitude" => "20",
            "longitude" => "45",
            "location" => [
                "country_flag" => "xy",
                "calling_code" => "26",
                "languages" => [
                    [
                        "name" => "French"
                    ]
                ]
            ]
        ];
        $res = $geoip->printGeoDetails($myjson);
        $this->assertIsString($res);
    }
}
