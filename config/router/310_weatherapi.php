<?php
/**
 * Weather API controller.
 */
return [
    "routes" => [
        [
            "info" => "Väder - API",
            "mount" => "weatherapi",
            "handler" => "\artes\Weather\WeatherAPIController",
        ],
    ]
];
