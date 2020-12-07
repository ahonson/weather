<?php

namespace artes\Curl;

/**
  * A class for curl requests
  *
  * @SuppressWarnings(PHPMD)
  */
class Curl
{
    /**
     *
     * @param string $url
     *
     */

    public function curl($url)
    {
        $ch = curl_init();
        curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_URL, $url);
        curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_RETURNTRANSFER, 1);
        $apiresponse = curl_exec(/** @scrutinizer ignore-type */ $ch);

        $jsonresp = json_decode($apiresponse, /** @scrutinizer ignore-type */ JSON_UNESCAPED_UNICODE);
        return $jsonresp;
    }
}
