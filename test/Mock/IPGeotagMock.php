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
    public function checkinputip($input) : string
    {
        $ipgeotag = new IPGeotag($input);
        $output = $ipgeotag->checkinputip($input);
        return $output;
    }
}
