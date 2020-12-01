<?php
/**
 * Weather API controller.
 */
return [
    "routes" => [
        [
            "info" => "Väder - API",
            "mount" => "weatherapi",
            "handler" => "\arte\Weather\Weather\WeatherAPIController",
        ],
    ]
];
