<?php

namespace artes\Weather;

/**
  * A class for validating weather parameters.
  *
  * @SuppressWarnings(PHPMD)
  */
class ValidWeather
{
    private $latitud;
    private $longitud;
    private $userip;
    private $ipadress;
    private $koordinater;
    private $ip;

    /**
     * Constructor to initiate an ValidWeather object,
     *
     * @param string $userinput
     *
     */
    public function __construct(object $userinput, object $ip)
    {
        $this->latitud = $userinput->getPost("latitud");
        $this->longitud = $userinput->getPost("longitud");
        $this->userip = $userinput->getPost("userip");
        $this->ipadress = $userinput->getPost("ipadress");
        $this->koordinater = $userinput->getPost("koordinater");
        $this->ip = $ip;
    }

    private function missingip() : bool
    {
        if ($this->ipadress) {
            if (!$this->userip) {
                return true;
            }
        }
        return false;
    }

    private function missingcoord() : bool
    {
        if ($this->koordinater) {
            if (!$this->longitud || !$this->latitud) {
                return true;
            }
        }
        return false;
    }

    public function validcoord() : bool
    {
        if (is_numeric($this->longitud) && is_numeric($this->latitud)) {
            if (abs($this->latitud) <= 90 && abs($this->longitud) <= 180) {
                return true;
            }
        }
        return false;
    }

    public function errormsg() : string
    {
        if ($this->missingip() || $this->missingcoord()) {
            return $this->wrapmsg("Missing input. Try again");
        }
        if (!$this->ip->validip($this->userip) && $this->ipadress) {
            return $this->wrapmsg("Invalid IP-address. Try again");
        }
        if (!$this->validcoord() && $this->koordinater) {
            return $this->wrapmsg("Invalid coordinates. Try again");
        }
        return "";
    }

    private function wrapmsg($msg) : string
    {
        return "<p class='warning'>" . $msg . "</p>";
    }
}
