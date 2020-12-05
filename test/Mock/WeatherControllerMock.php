<?php

namespace artes\Weather;

/**
 * Class for mocking IPController
 * @SuppressWarnings(PHPMD)
 */
class WeatherControllerMock extends WeatherController
{
    /**
    *
    * @return object
    */
    public function indexActionPost() : object
    {
        $page = $this->di->get("page");
        $weatherinfo = [
            "name" => "Bud",
            "weather" => [
                [
                    "description" => "Description"
                ]
            ],
            "main" => [
                "temp" => "-3",
                "feels_like" => "-5",
                "temp_min" => "-10",
                "temp_max" => "2"
            ]
        ];
        $forecast = false;
        $historic = false;
        $data = [
            "weatherinfo" => $weatherinfo,
            "map" => "https://www.openstreetmap.org/#map=16/47.4532/19.1407",
            "geoinfo" => "",
            "forecast" => $forecast,
            "historic" => $historic
        ];
        $page->add(
            "weather/info",
            $data
        );

        // die("vavavava");
        return $page->render([
            "title" => "My IP",
        ]);
    }
}
