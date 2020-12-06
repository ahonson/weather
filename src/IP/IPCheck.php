<?php

namespace artes\IP;

/**
  * A class for validating IP addresses.
  *
  * @SuppressWarnings(PHPMD)
  */
class IPCheck
{
    private $userinput;
    private $correctedinput;
    private $domain;

    /**
     * Constructor to initiate an IP object,
     *
     * @param string $userinput
     *
     */
    public function __construct(string $userinput)
    {
        $this->userinput = $userinput;
        $this->correctedinput = "";
        $this->domain = "";
        $this->setDomainName();
        $this->input2ip6();
    }

    public function validip() : bool
    {
        if ($this->ipv4() || $this->ipv6()) {
            return true;
        }
        return false;
    }

    public function ipv4() : bool
    {
        $ipv4 = "/^(([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])$/";

        if (preg_match($ipv4, $this->userinput)) {
            return true;
        }

        return false;
    }

    public function ipv6() : bool
    {
        $ipv6 = "/^(([0-9]|[a-f]|[A-F]){4}:){7}([0-9]|[a-f]|[A-F]){4}$/";

        if (preg_match($ipv6, $this->correctedinput)) {
            return true;
        }

        return false;
    }

    private function input2ip6() : string
    {
        $newip6 = [];
        if ($this->userinput) {
            $mymy = explode(":", $this->userinput);
            if ($mymy[0] === "") {
                array_shift($mymy);
            } elseif ($mymy[count($mymy) -1] === "") {
                array_pop($mymy);
            }
            $mycount = count($mymy);
            $missing = 8 - $mycount; // IPv6 has eight 16bit blocks
            for ($i=0; $i < $mycount; $i++) {
                array_push($newip6, str_pad($mymy[$i], 4, "0", STR_PAD_LEFT));
                if ($mymy[$i] === "") {
                    for ($j=0; $j < $missing; $j++) {
                        array_push($newip6, str_pad($mymy[$i], 4, "0", STR_PAD_LEFT));
                    }
                }
            }
        }
        $newip6str = implode(":", $newip6);
        $this->correctedinput = $newip6str;
        return $this->correctedinput;
    }

    public function getUserInput() : string
    {
        return $this->userinput;
    }

    public function getCorrectedInput() : string
    {
        return $this->correctedinput;
    }

    public function setDomainName() : void
    {
        if ($this->ipv4()) {
            if ($this->userinput != gethostbyaddr($this->userinput)) {
                $this->domain = gethostbyaddr($this->userinput);
            }
        } elseif ($this->ipv6()) {
            if ($this->correctedinput != gethostbyaddr($this->correctedinput)) {
                $this->domain = gethostbyaddr($this->correctedinput);
            }
        }
    }

    public function getDomainName() : string
    {
        return $this->domain;
    }

    public function printIPMessage() : string
    {
        if ($this->ipv4()) {
            $lastChunk = "enligt IPv4.";
        } elseif ($this->ipv6()) {
            $lastChunk = "enligt IPv6.";
        } else {
            $lastChunk = "inte.";
        }
        $ip = $this->getUserInput();
        return "Den inmatade strängen ($ip) validerar $lastChunk";
    }

    public function printDomainMessage() : string
    {
        $msg = "";
        if ($this->getDomainName()) {
            $msg = "Det tillhörande domännamnet är " . $this->getDomainName() . ".";
        } elseif ($this->ipv4() || $this->ipv6()) {
            $msg = "Men inget domännamn har hittats.";
        } else {
            $msg = "Det finns inget domännamn att visa.";
        }
        return $msg;
    }

    public function printAllMessages() : string
    {
        if ($this->userinput) {
            $msg = "<h2>Resultat</h2><p>" . $this->printIPMessage() . "</p><p>" . $this->printDomainMessage() . "</p>";
        } else {
            $msg = "";
        }

        return $msg;
    }
}
