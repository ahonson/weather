<?php

namespace artes\IP;


/**
 * Class for mocking IPController
 * @SuppressWarnings(PHPMD)
 */
class IPAPIControllerMock extends IPAPIController
{
    /**
    *
    * @return array
    */
    public function checkActionGet() : array
    {
        $myjson = [
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

        return [json_encode($myjson, JSON_UNESCAPED_UNICODE)];
    }

    /**
    *
    * @return array
    */
    public function checkActionPost() : array
    {
        $myjson = [
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

        return [json_encode($myjson, JSON_UNESCAPED_UNICODE)];
    }
}
