<?php

namespace artes\Weather;

/**
  * A class for OpenWeatherMap.
  *
  * @SuppressWarnings(PHPMD)
  */
class OpenWeather
{
    private $weatherkey;
    private $lat;
    private $long;

    /**
     * Constructor to initiate an OpenWeather object,
     *
     * @param string $userinput
     *
     */
    public function __construct(string $weatherkey, string $lat, string $long)
    {
        $this->weatherkey = $weatherkey;
        $this->lat = $lat;
        $this->long = $long;
    }

    public function currentweather() : array
    {
        $ch = curl_init();
        $url = "https://api.openweathermap.org/data/2.5/weather?lat=" . $this->lat . "&lon=" . $this->long . "&appid=" . $this->weatherkey . "&units=metric&lang=se";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $apiresponse = curl_exec($ch);

        $jsonresp = json_decode($apiresponse, JSON_UNESCAPED_UNICODE);
        return $jsonresp;
    }

    public function forecast() : array
    {
        $ch = curl_init();
        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=" . $this->lat . "&lon=" . $this->long . "&exclude=minutely,hourly&appid=" . $this->weatherkey . "&units=metric&lang=se";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $apiresponse = curl_exec($ch);

        $jsonresp = json_decode($apiresponse, JSON_UNESCAPED_UNICODE);
        return $jsonresp;
    }

    // multiple curls serially
    // public function historicweather() : array
    // {
    //     $days = $this->generateTimestamps();
    //     $result = [];
    //     $mh = curl_multi_init();
    //     for ($i = 0; $i < count($days); $i++) {
    //         $ch = curl_init();
    //         $url = "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=" . $this->lat . "&lon=" . $this->long .  "&dt=" . $days[$i]. "&appid=" . $this->weatherkey . "&units=metric&lang=se";
    //         curl_setopt($ch, CURLOPT_URL, $url);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //         $apiresponse = curl_exec($ch);
    //         $jsonresp = json_decode($apiresponse, JSON_UNESCAPED_UNICODE);
    //         $result[] = $jsonresp;
    //         curl_close ($ch);
    //     }
    //     return $result;
    // }

    // multiple curls parallelly
    public function historicweather() : array
    {
        $result = [];
        $days = $this->generateTimestamps();
        $urls = [];
        $mycount = count($days);
        for ($i = 0; $i < $mycount; $i++) {
            $urls[] = "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=" . $this->lat . "&lon=" . $this->long .  "&dt=" . $days[$i]. "&appid=" . $this->weatherkey . "&units=metric&lang=se";
        }
        $multi = curl_multi_init();
        $handles = [];
        foreach ($urls as $url) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_multi_add_handle($multi, $ch);
            $handles[$url] = $ch;
        }
        do {
            $mrc = curl_multi_exec($multi, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            do {
                $mrc = curl_multi_exec($multi, $active);
            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }
        foreach ($handles as $channel) {
            $html = curl_multi_getcontent($channel);
            $jsonresp = json_decode($html, JSON_UNESCAPED_UNICODE);
            $result[] = $jsonresp;
            curl_multi_remove_handle($multi, $channel);
        }
        curl_multi_close($multi);
        return $result;
    }

    private function generateTimestamps($timestamp = null) : array
    {
        if (!$timestamp) {
            $timestamp = time();
        }
        $day = 60*60*24;
        $result = array();
        for ($i = 0; $i < 5; $i++) {
            $timestamp -= $day;
            array_push($result, $timestamp);
        }
        return $result;
    }
}
