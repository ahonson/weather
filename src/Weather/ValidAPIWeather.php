<?php

namespace artes\Weather;

/**
  * A class for validating weather parameters.
  *
  * @SuppressWarnings(PHPMD)
  */
class ValidAPIWeather extends ValidWeather
{
    private $latitud;
    private $longitud;
    private $userip;
    private $ip;

    /**
     * Constructor to initiate an ValidWeather object,
     *
     * @param string $userinput
     *
     */
    public function __construct(object $userinput, object $ip)
    {
        if ($userinput->getMethod() === "GET") {
            $this->latitud = $userinput->getGet("lat", null);
            $this->longitud = $userinput->getGet("lon", null);
            $this->userip = $userinput->getGet("ip", null);
        } elseif ($userinput->getMethod() === "POST") {
            $this->latitud = $userinput->getPost("latitud", null);
            $this->longitud = $userinput->getPost("longitud", null);
            $this->userip = $userinput->getPost("userip", null);
        } else {
            $this->latitud = "";
            $this->longitud = "";
            $this->userip = "";
        }
        $this->ip = $ip;
    }

    private function missinginput() : bool
    {
        if ($this->userip || ($this->latitud && $this->longitud)) {
            return false;
        }
        return true;
    }

    public function errormsg() : string
    {
        if ($this->missinginput()) {
            $msg = "Missing input. Try again";
        } elseif (!$this->ip->validip($this->userip) && !$this->validcoord($this->longitud, $this->latitud)) {
            $msg = "Invalid query parameters. Try again";
        } else {
            $msg = "";
        }
        return $msg;
    }
}
