<?php

use Monolog\Logger;

return array(
    'server'          => "mongodb://192.168.200.166:27017",
    'database'        => 'logs_pro',
    'collection'      => 'api-store',
    'log_level'       => Logger::DEBUG,
    'time_zone'       => 'UTC',
    'datetime_format' => 'Y-m-d H:i:s',
);