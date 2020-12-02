<?php
/**
 * Configuration file for DI container.
 */
return [
    "services" => [
        "ip" => [
            "shared" => true,
            "callback" => function () {
                $ip = new \arte\IP\IP();
                return $ip;
            }
        ],
    ],
];
