<?php

namespace artes\IP;


/**
 * Class for mocking IPController
 * @SuppressWarnings(PHPMD)
 */
class IPGeotagMock extends IPGeotag
{
    /**
    *
    * @return string
    */
    public function getMap($input) : string
    {
        $mymap = "https://www.openstreetmap.org/#map=16/47.4532/19.$input";
        return $mymap;
    }

    /**
    *
    * @return string
    */
    public function checkinputip($input) : string
    {
        return "$input";
    }
}
