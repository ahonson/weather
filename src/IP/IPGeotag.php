<?php

namespace artes\IP;

/**
  * A class for geotagging IP addresses.
  *
  * @SuppressWarnings(PHPMD)
  */
class IPGeotag
{
    /**
     * Constructor to initiate an IP object,
     *
     * @param string $userinput
     *
     */

    public function __construct(string $ipkey)
    {
        $this->ipkey = $ipkey;
    }

    public function checkuserip() : array
    {
        $ch = curl_init();
        $url = "http://api.ipstack.com/check?access_key=";
        curl_setopt($ch, CURLOPT_URL, $url . $this->ipkey);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $apiresponse = curl_exec($ch);

        $jsonresp = json_decode($apiresponse, JSON_UNESCAPED_UNICODE);
        return $jsonresp;
    }

    public function checkdefaultip($input) : array
    {
        $ch = curl_init();
        $url = "http://api.ipstack.com/$input?access_key=";
        curl_setopt($ch, CURLOPT_URL, $url . $this->ipkey);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $apiresponse = curl_exec($ch);

        $jsonresp = json_decode($apiresponse, JSON_UNESCAPED_UNICODE);
        if (!$jsonresp) {
            $jsonresp = ["ip" => ""];
        }
        return $jsonresp;
    }

    public function getmap($input) : string
    {
        $myjson = $this->checkdefaultip($input);
        if (isset($myjson["latitude"])) {
            if ($myjson["latitude"]) {
                $map = "https://www.openstreetmap.org/?mlat=" . $myjson["latitude"] . "&mlon=" . $myjson["longitude"] . "#map=10/" . $myjson["latitude"] . "/" . $myjson["longitude"];
                return $map;
            }
        }
        return "";
    }

    public function parseJson($ip, $arg1, $arg2 = null, $arg3 = null) : string
    {
        $jsonresp = $this->checkdefaultip($ip);
        if ($arg3) {
            return $jsonresp[$arg1][$arg2][0][$arg3] ?? "";
        }
        if ($arg2) {
            return $jsonresp[$arg1][$arg2] ?? "";
        }
        return $jsonresp[$arg1] ?? "";
    }

    public function checkinputip($input) : string
    {
        if ($input) {
            $ch = curl_init();
            $url = "http://api.ipstack.com/$input?access_key=";
            curl_setopt($ch, CURLOPT_URL, $url . $this->ipkey);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $apiresponse = curl_exec($ch);

            $jsonresp = json_decode($apiresponse, JSON_UNESCAPED_UNICODE);
            if (isset($jsonresp["type"])) {
                if ($jsonresp["type"] === "ipv4" || $jsonresp["type"] === "ipv6") {
                    return $this->printGeoDetails($jsonresp);
                }
            }
        }
        return "";
    }

    public function printmap($lat, $lon) : string
    {
        if (!is_numeric($lat) || !is_numeric($lon)) {
            return "";
        }
        $msg = '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox='. ($lon - 1) . '%2C' . ($lat - 1) . '%2C' . ($lon + 1) . '%2C' . ($lat + 1);
        $msg = $msg . '&amp;layer=mapnik&amp;marker=' . $lat . "%2C" . $lon . '" style="border: 1px solid black"></iframe><br/>';
        $msg = $msg . "<p>Click here for a <a href='https://www.openstreetmap.org/?mlat=" . $lat . "&mlon=" . $lon . "#map=10/" . $lat . "/" . $lon . "' target='_blank'> larger map</a>.</p>";
        return $msg;
    }

    public function printGeoDetails($myjson) : string
    {
        $msg = "<h3>Ytterligare information från Ipstacks API</h3>";
        $msg = $msg . "<p><strong>Continent</strong>: " . $myjson["continent_name"] . "</p>";
        $msg = $msg . "<p><strong>Country</strong>: " . $myjson["country_name"] . " (" . $myjson["country_code"] . " +" . $myjson["location"]["calling_code"] . ") <img class='inlineimg' src='" . $myjson["location"]["country_flag"] . "' alt='" . $myjson["country_name"] . "'></p>";
        $msg = $msg . "<p><strong>City</strong>: " . $myjson["city"] . "</p>";
        $msg = $msg . "<p><strong>Zip</strong>: " . $myjson["zip"] . "</p>";
        $msg = $msg . "<p><strong>Language</strong>: " . $myjson["location"]["languages"][0]["name"] . "</p>";
        $msg = $msg . "<p><strong>Coordinates</strong>: " . $myjson["latitude"] . "°, " . $myjson["longitude"] . "°</p>";
        $msg = $msg . '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox='. ($myjson["longitude"] - 1) . '%2C' . ($myjson["latitude"] - 1) . '%2C' . ($myjson["longitude"] + 1) . '%2C' . ($myjson["latitude"] + 1);
        $msg = $msg . '&amp;layer=mapnik&amp;marker=' . $myjson["latitude"] . "%2C" . $myjson["longitude"] . '" style="border: 1px solid black"></iframe><br/>';
        $msg = $msg . "<p>Click here for a <a href='https://www.openstreetmap.org/?mlat=" . $myjson["latitude"] . "&mlon=" . $myjson["longitude"] . "#map=10/" . $myjson["latitude"] . "/" . $myjson["longitude"] . "' target='_blank'> larger map</a>.</p>";
        return $msg;
    }
}
