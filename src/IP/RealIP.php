<?php

namespace arte\IP;

/**
  * A class for getting real IP addresses.
  *
  * @SuppressWarnings(PHPMD)
  */
class RealIP
{
    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // Check IP from internet.
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // Check IP is passed from proxy.
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            // Get IP address from remote address.
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = "94.21.49.200";
        }
        return $ip;
    }
}
