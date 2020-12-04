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
        // $ipgeotag = new IPGeotag($input);
        // $mymap = $ipgeotag->getMap("8.8.8.8");
        $mymap = "https://www.openstreetmap.org/#map=16/47.4532/19.$input";
        return $mymap;
    }

    /**
    *
    * @return string
    */
    public function checkinputip($input) : string
    {
        $ipgeotag = new IPGeotag($input);
        $output = $ipgeotag->checkinputip($input);
        return $output;
    }
}
