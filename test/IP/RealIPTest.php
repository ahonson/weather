<?php

namespace artes\IP;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class RealIPTest extends TestCase
{
    /**
     * RealIP
     */
    public function testGetRealIpAddr()
    {
        $_SERVER["REMOTE_ADDR"] = "8.8.8.8";
        $realip1 = new RealIP();
        $res1 = $realip1->getRealIpAddr();

        $_SERVER["HTTP_X_FORWARDED_FOR"] = "8.8.8.8";
        $realip2 = new RealIP();
        $res2 = $realip2->getRealIpAddr();

        $_SERVER["HTTP_CLIENT_IP"] = "8.8.8.8";
        $realip3 = new RealIP();
        $res3 = $realip3->getRealIpAddr();

        $this->assertIsString($res1);
        $this->assertIsString($res2);
        $this->assertIsString($res3);
    }
}
