<?php

namespace artes\IP;

use PHPUnit\Framework\TestCase;

/**
  * A class for validating weather parameters.
  *
  * @SuppressWarnings(PHPMD)
  */
class IPCheckTest extends TestCase
{
    /**
     * IPCheck
     */
    public function testIpv6()
    {
        $ipcheck = new IPCheck("4::5");
        $res = $ipcheck->ipv6();
        $this->assertTrue($res);
    }

    /**
     * IPCheck
     */
    public function testIpv4()
    {
        $ipcheck = new IPCheck("4.5.6.7");
        $res = $ipcheck->ipv4();
        $this->assertTrue($res);
    }

    /**
     * IPCheck
     */
    public function testGetCorrectedInput()
    {
        $ipcheck = new IPCheck("::5");
        $res = $ipcheck->getCorrectedInput();
        $this->assertIsString($res);
    }

    /**
     * IPCheck
     */
    public function testPrintIPMessage()
    {
        $ipcheck = new IPCheck("::5");
        $res = $ipcheck->printIPMessage();
        $ipcheck1 = new IPCheck("blabla");
        $res1 = $ipcheck1->printIPMessage();
        $ipcheck2 = new IPCheck("8.8.8.8");
        $res2 = $ipcheck2->printIPMessage();
        $this->assertIsString($res);
        $this->assertIsString($res1);
        $this->assertStringEndsWith("enligt IPv4.", $res2);
    }

    /**
     * IPCheck
     */
    public function testPrintDomainMessage()
    {
        $ipcheck = new IPCheck("4::");
        $res = $ipcheck->printDomainMessage();
        $ipcheck1 = new IPCheck("345.45.453.4");
        $res1 = $ipcheck1->printDomainMessage();
        $ipcheck2 = new IPCheck("8.8.8.8");
        $res2 = $ipcheck2->printDomainMessage();
        $this->assertIsString($res);
        $this->assertIsString($res1);
        $this->assertStringStartsWith("Det", $res2);
    }

    /**
     * IPCheck
     */
    public function testPrintAllMessages()
    {
        $ipcheck = new IPCheck("4::");
        $res = $ipcheck->printAllMessages();
        $ipcheck1 = new IPCheck("");
        $res1 = $ipcheck1->printAllMessages();
        $this->assertIsString($res);
        $this->assertEquals($res1, "");
    }

    /**
     * IPCheck
     */
    public function testSetDomainName()
    {
        $ipcheck = new IPCheck("2620:0:2d0:200::7");
        $res = $ipcheck->setDomainName();
        $this->assertNull($res);
    }


    /**
     * IPCheck
     */
    public function testValidIp()
    {
        $ip = new IPCheck("4::5");
        $res = $ip->validip();
        $ip1 = new IPCheck(":x:x:");
        $res1 = $ip1->validip();
        $this->assertTrue($res);
        $this->assertFalse($res1);
    }
}
