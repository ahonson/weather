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
        $res = $geoip->getmap("567");
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
        $this->assertIsString($res);
    }

    /**
     * IPGeotag
     */
    public function testcheckinputip()
    {
        $ipkey = "78956734565756767868";
        $geoip = new IPGeotagMock($ipkey);
        $res = $geoip->checkinputip("694.21.49.200");
        $this->assertIsString($res);
    }
}
