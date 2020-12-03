<?php
/**
 * Weather controller.
 */
return [
    "routes" => [
        [
            "info" => "Weather service",
            "mount" => "weather",
            "handler" => "\artes\Weather\WeatherController",
        ],
    ]
];
