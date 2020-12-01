<?php

namespace arts19\Weather;

/**
  * A class for validating weather parameters.
  *
  * @SuppressWarnings(PHPMD)
  */
class ValidWeather
{
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

    private function validip() : bool
    {
        return $this->ip->validip($this->userip);
    }

    private function validcoord() : bool
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
            $msg = "Missing input. Try again";
        } elseif (!$this->validip() && $this->ipadress) {
            $msg = "Invalid IP-address. Try again";
        } elseif (!$this->validcoord() && $this->koordinater) {
            $msg = "Invalid coordinates. Try again";
        } else {
            $msg = "";
        }
        if ($msg) {
            $msg = $this->wrapmsg($msg);
        }
        return $msg;
    }

    private function wrapmsg($msg) : string
    {
        return "<p class='warning'>" . $msg . "</p>";
    }
}
