<?php
/**
 * Weather controller.
 */
return [
    "routes" => [
        [
            "info" => "Weather service",
            "mount" => "weather",
            "handler" => "\arte\Weather\Weather\WeatherController",
        ],
    ]
];
