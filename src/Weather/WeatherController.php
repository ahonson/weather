<?php

namespace Anax\Controller;

namespace arte\Weather;

// use Anax\Commons\AppInjectableInterface;
// use Anax\Commons\AppInjectableTrait;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Route\Exception\NotFoundException;
use arte\IP\IPGeotag;
use arte\IP\RealIP;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD)
 */
class WeatherController implements ContainerInjectableInterface
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
        $session = $this->di->get("session");
        $realip = new RealIP();
        $ipaddress = $realip->getRealIpAddr();
        $data = [
            "warning" => $session->get("warning"),
            "ip" => $ipaddress
        ];
        $session->destroy();

        $page->add(
            "weather/index",
            $data
        );

        return $page->render([
            "title" => "Weather",
        ]);
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexActionPost() : object
    {
        $ip = $this->di->get("ip");
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $session = $this->di->get("session");
        $validator = new ValidWeather($request, $ip);
        if ($validator->errormsg()) {
            $session->set("warning", $validator->errormsg());
            return $response->redirect("weather");
        }

        // this loads $ipkey and $weatherkey
        include(ANAX_INSTALL_PATH . '/config/api/apikeys.php');
        $page = $this->di->get("page");
        $lat = $request->getPost("latitud");
        $long = $request->getPost("longitud");
        $geotag = new IPGeotag($ipkey);
        $geoinfo = "";
        if ($request->getPost("userip")) {
            $input = $request->getPost("userip");
            $geoinfo = $geotag->checkdefaultip($input);
            $lat = $geoinfo["latitude"];
            $long = $geoinfo["longitude"];
            $geoinfo = $geotag->checkinputip($input);
        }
        $map = $geotag->printmap($lat, $long);
        $openweather = new OpenWeather($weatherkey, $lat, $long);
        $weatherinfo = $openweather->currentweather();
        if ($request->getPost("infotyp") === "historik") {
            $historic = $openweather->historicweather();
            $forecast = "";
        } else {
            $forecast = $openweather->forecast();
            $historic = "";
        }

        $data = [
            "weatherinfo" => $weatherinfo,
            "map" => $map,
            "geoinfo" => $geoinfo,
            "forecast" => $forecast,
            "historic" => $historic
        ];

        $page->add(
            "weather/info",
            $data
        );
        return $page->render([
            "title" => "Weather",
        ]);
    }
}
