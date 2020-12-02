<?php

namespace Anax\Controller;

namespace arte\IP;

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
        $userip = new IPCheck($ip);
        $ip4 = $userip->ipv4();
        $ip6 = $userip->ipv6();
        $userinput = $userip->getUserInput();
        $corrected = $userip->getCorrectedInput();
        $domain = $userip->getDomainName();
        $ipmsg = $userip->printIPMessage();
        $domainmsg = $userip->printDomainMessage();

        // this loads $ipkey and $weatherkey
        include(ANAX_INSTALL_PATH . '/config/api/apikeys.php');
        $geoip = new IPGeotag($ipkey);
        $continent = $geoip->parseJson($ip, "continent_name");
        $country = $geoip->parseJson($ip, "country_name");
        $city = $geoip->parseJson($ip, "city");
        $zip = $geoip->parseJson($ip, "zip");
        $language = $geoip->parseJson($ip, "location", "languages", "name");
        $latitude = $geoip->parseJson($ip, "latitude");
        $longitude = $geoip->parseJson($ip, "longitude");
        $map = $geoip->getmap($ip);

        $myjson = [
            "ip4" => $ip4,
            "ip6" => $ip6,
            "userinput" => $userinput,
            "corrected" => $corrected,
            "domain" => $domain,
            "ipmsg" => $ipmsg,
            "domainmsg" => $domainmsg,
            "continent" => $continent,
            "country" => $country,
            "city" => $city,
            "zip" => $zip,
            "language" => $language,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "map" => $map
        ];

        return [json_encode($myjson, JSON_UNESCAPED_UNICODE)];
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
        $userip = new IPCheck($ip);
        $ip4 = $userip->ipv4();
        $ip6 = $userip->ipv6();
        $userinput = $userip->getUserInput();
        $corrected = $userip->getCorrectedInput();
        $domain = $userip->getDomainName();
        $ipmsg = $userip->printIPMessage();
        $domainmsg = $userip->printDomainMessage();

        // this loads $ipkey and $weatherkey
        include(ANAX_INSTALL_PATH . '/config/api/apikeys.php');
        $geoip = new IPGeotag($ipkey);
        $continent = $geoip->parseJson($ip, "continent_name");
        $country = $geoip->parseJson($ip, "country_name");
        $city = $geoip->parseJson($ip, "city");
        $zip = $geoip->parseJson($ip, "zip");
        $language = $geoip->parseJson($ip, "location", "languages", "name");
        $latitude = $geoip->parseJson($ip, "latitude");
        $longitude = $geoip->parseJson($ip, "longitude");
        $map = $geoip->getmap($ip);

        $myjson = [
            "ip4" => $ip4,
            "ip6" => $ip6,
            "userinput" => $userinput,
            "corrected" => $corrected,
            "domain" => $domain,
            "ipmsg" => $ipmsg,
            "domainmsg" => $domainmsg,
            "continent" => $continent,
            "country" => $country,
            "city" => $city,
            "zip" => $zip,
            "language" => $language,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "map" => $map
        ];

        return [json_encode($myjson, JSON_UNESCAPED_UNICODE)];
    }
}
