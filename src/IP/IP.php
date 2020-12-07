<?php

namespace artes\IP;

/**
  * A class for validating IP addresses.
  *
  * @SuppressWarnings(PHPMD)
  */
class IP
{
    public function validip($ip) : bool
    {
        if ($this->ipv4($ip) || $this->ipv6($ip)) {
            return true;
        }
        return false;
    }

    public function ipv4($ip) : bool
    {
        $ipv4 = "/^(([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])$/";

        if (preg_match($ipv4, $ip)) {
            return true;
        }

        return false;
    }

    public function ipv6($ip) : bool
    {
        $ipv6 = "/^(([0-9]|[a-f]|[A-F]){4}:){7}([0-9]|[a-f]|[A-F]){4}$/";

        $iptoip6 = $this->input2ip6($ip);

        if (preg_match($ipv6, $iptoip6)) {
            return true;
        }

        return false;
    }

    public function padIP($mymy) : array
    {
        $newip6 = [];
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
        return $newip6;
    }

    public function corrected($ipinput) : array
    {
        $newip6 = [];
        if ($ipinput) {
            $mymy = explode(":", $ipinput);
            if ($mymy[0] === "") {
                array_shift($mymy);
            } elseif ($mymy[count($mymy) -1] === "") {
                array_pop($mymy);
            }
            $newip6 = $this->padIP($mymy);
        }
        return $newip6;
    }

    private function input2ip6($ip) : string
    {
        $newip6 = $this->corrected($ip);
        // $newip6 = [];
        // if ($ip) {
        //     $mymy = explode(":", $ip);
        //     if ($mymy[0] === "") {
        //         array_shift($mymy);
        //     } elseif ($mymy[count($mymy) -1] === "") {
        //         array_pop($mymy);
        //     }
        //     $mycount = count($mymy);
        //     $missing = 8 - $mycount; // IPv6 has eight 16bit blocks
        //     for ($i=0; $i < $mycount; $i++) {
        //         array_push($newip6, str_pad($mymy[$i], 4, "0", STR_PAD_LEFT));
        //         if ($mymy[$i] === "") {
        //             for ($j=0; $j < $missing; $j++) {
        //                 array_push($newip6, str_pad($mymy[$i], 4, "0", STR_PAD_LEFT));
        //             }
        //         }
        //     }
        // }
        $newip6str = implode(":", $newip6);
        return $newip6str;
    }
}
