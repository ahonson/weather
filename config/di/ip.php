<?php
/**
 * Configuration file for DI container.
 */
return [
    "services" => [
        "ip" => [
            "shared" => true,
            "callback" => function () {
                $ip = new \artes\IP\IP();
                return $ip;
            }
        ],
    ],
];
