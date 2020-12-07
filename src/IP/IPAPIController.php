<?php

namespace Anax\Controller;

namespace artes\IP;

// use Anax\Commons\AppInjectableInterface;
// use Anax\Commons\AppInjectableTrait;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Route\Exception\NotFoundException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD)
 */
class IPAPIController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $realip = new RealIP();
        $ipaddress = $realip->getRealIpAddr();
        $data = [
            "ip" => $ipaddress
        ];
        $page->add(
            "ip/ipapi",
            $data
        );

        return $page->render([
            "title" => "My IP",
        ]);
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return array
     */
    public function checkActionGet() : array
    {
        $request = $this->di->get("request");
        $ip  = $request->getGet("ip", "");
        $firstJSON = $this->generateJSON1($ip);
        $myjson = $this->generateJSON2($firstJSON, $ip);
        return [json_encode($myjson, JSON_UNESCAPED_UNICODE)];
    }

    public function generateJSON1($ip)
    {
        $userip = new IPCheck($ip);
        $ip4 = $userip->ipv4();
        $ip6 = $userip->ipv6();
        $userinput = $userip->getUserInput();
        $corrected = $userip->getCorrectedInput();
        $domain = $userip->getDomainName();
        $ipmsg = $userip->printIPMessage();
        $domainmsg = $userip->printDomainMessage();
        $firstJSON = [
            "ip4" => $ip4,
            "ip6" => $ip6,
            "userinput" => $userinput,
            "corrected" => $corrected,
            "domain" => $domain,
            "ipmsg" => $ipmsg,
            "domainmsg" => $domainmsg,
        ];
        return $firstJSON;
    }

    public function generateJSON2($myjson, $ip)
    {
        $ipkey = "";
        // this loads $ipkey and $weatherkey
        include(ANAX_INSTALL_PATH . '/config/api/apikeys.php');
        $geoip = new IPGeotag($ipkey);
        $myjson["continent"] = $geoip->parseJson($ip, "continent_name");
        $myjson["country"] = $geoip->parseJson($ip, "country_name");
        $myjson["city"] = $geoip->parseJson($ip, "city");
        $myjson["zip"] = $geoip->parseJson($ip, "zip");
        $myjson["language"] = $geoip->parseJson($ip, "location", "languages", "name");
        $myjson["latitude"] = $geoip->parseJson($ip, "latitude");
        $myjson["longitude"] = $geoip->parseJson($ip, "longitude");
        $myjson["map"] = $geoip->getmap($ip);

        return $myjson;
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return array
     */
    public function checkActionPost() : array
    {
        $request = $this->di->get("request");
        $ip  = $request->getPost("ip", "");
        $firstJSON = $this->generateJSON1($ip);
        $myjson = $this->generateJSON2($firstJSON, $ip);
        return [json_encode($myjson, JSON_UNESCAPED_UNICODE)];
    }
}
