<?php
/**
 * Configuration file for DI container.
 */
return [
    "services" => [
        "ip" => [
            "shared" => true,
            "callback" => function () {
                $ip = new \arte\Weather\IP\IP();
                return $ip;
            }
        ],
    ],
];
