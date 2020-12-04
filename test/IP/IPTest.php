<?php

namespace artes\IP;

use PHPUnit\Framework\TestCase;

/**
  * A class for validating weather parameters.
  *
  * @SuppressWarnings(PHPMD)
  */
class IPTest extends TestCase
{
    /**
     * IP
     */
    public function testIpv6()
    {
        $ip = new IP();
        $res = $ip->ipv6("4::5");
        $ip1 = new IP();
        $res1 = $ip1->ipv6(":x:x:");
        $ip2 = new IP();
        $res2 = $ip2->ipv6("3:x::");
        $this->assertTrue($res);
        $this->assertFalse($res1);
        $this->assertFalse($res2);
    }


    public function testIpv4()
    {
        $ip = new IP();
        $res = $ip->ipv4("8.8.8.8");
        $ip1 = new IP();
        $res1 = $ip1->ipv4("4::5");
        $this->assertTrue($res);
        $this->assertFalse($res1);
    }

    public function testValidIp()
    {
        $ip = new IP();
        $res = $ip->validip("4::5");
        $ip1 = new IP();
        $res1 = $ip1->validip(":x:x:");
        $this->assertTrue($res);
        $this->assertFalse($res1);
    }
}
