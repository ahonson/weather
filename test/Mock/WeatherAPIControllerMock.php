<?php

namespace artes\Weather;


/**
 * Class for mocking IPController
 * @SuppressWarnings(PHPMD)
 */
class WeatherAPIControllerMock extends WeatherAPIController
{
    /**
    *
    * @return array
    */
    public function infoActionGet() : array
    {
        $data = [
            "ip4" => true,
            "ip6" => false,
            "userinput" => "8.8.8.8",
            "corrected" => "8.8.8.8",
            "domain" => "www.google.com",
            "ipmsg" => "Success",
            "domainmsg" => "Domain",
            "continent" => "North America",
            "country" => "USA",
            "city" => "NYC",
            "zip" => "12345",
            "language" => "English",
            "latitude" => "20",
            "longitude" => "-122",
            "map" => "maplink"
        ];

        return [json_encode($data, JSON_UNESCAPED_UNICODE)];
    }

    /**
    *
    * @return array
    */
    public function infoActionPost() : array
    {
        $data = [
            "ip4" => true,
            "ip6" => false,
            "userinput" => "8.8.8.8",
            "corrected" => "8.8.8.8",
            "domain" => "www.google.com",
            "ipmsg" => "Success",
            "domainmsg" => "Domain",
            "continent" => "North America",
            "country" => "USA",
            "city" => "NYC",
            "zip" => "12345",
            "language" => "English",
            "latitude" => "20",
            "longitude" => "-122",
            "map" => "maplink"
        ];

        return [json_encode($data, JSON_UNESCAPED_UNICODE)];
    }
}
