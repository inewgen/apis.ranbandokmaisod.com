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

        // 'mysql' => array(
        //     'driver'    => 'mysql',
        //     'read' => array(
        //         'host' => 'localhost', //61.91.1.146
        //     ),
        //     'write' => array(
        //         'host' => 'localhost' // 61.91.1.146
        //     ),
        //     'database'  => 'ranbandokmaisod', //authen
        //     'username'  => 'homestead', // dev
        //     'password'  => 'secret', // dev!          'password'  => 'secret',
        //     'charset'   => 'utf8',
        //     'collation' => 'utf8_unicode_ci',
        //     'prefix'    => '',
        // ),
        'mysql' => array(
            'driver'    => 'mysql',
            'read' => array(
                'host' => '31.220.110.131', //61.91.1.146
            ),
            'write' => array(
                'host' => '31.220.110.131' // 61.91.1.146
            ),
            'database'  => 'u877211466_rbdm', //authen
            'username'  => 'u877211466_rbdm', // dev
            'password'  => 'Pat@0913763153', // dev!           'password'  => 'secret',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
        
    ),

);
