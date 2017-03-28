<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => array(

        'mysql' => array(
            'driver'    => 'mysql',
            'read' => array(
                //'host' => 'xxxxx', //61.91.1.146
                'host' => 'xxxx', //61.91.1.146
            ),
            'write' => array(
                //'host' => 'xxxxx' // 61.91.1.146
                'host' => 'xxxx', //61.91.1.146

            ),
            'database'  => 'stores', //authen
            'username'  => 'root', // dev
            'password'  => 'wel0ve!', // dev!          'password'  => 'secret',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),

        'pgsql' => array(
            'driver'   => 'pgsql',
            'host'     => 'localhost',
            'database' => 'homestead',
            'username' => 'homestead',
            'password' => 'secret',
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
        ),
        'mongodb' => array(
            'driver'   => 'mongodb',
            'host'     => 'xxxx',
            'port'     => 27033,
            'username' => 'suwls',
            'password' => 'suw154!',
            'database' => 'weloveshopping'
        ),
    ),

);
