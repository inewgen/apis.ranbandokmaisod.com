<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application();

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
*/

$envMapping = [
    'apis.ranbandokmaisod.dev'   => 'local',
    'admins.ranbandokmaisod.dev' => 'local',
    'www.ranbandokmaisod.dev'    => 'local',
    'res.ranbandokmaisod.dev'    => 'local',
];

$env = $app->detectEnvironment(function () use ($envMapping) {
    return isset($_SERVER['HTTP_HOST']) && isset($envMapping[$_SERVER['HTTP_HOST']])
        ? $envMapping[$_SERVER['HTTP_HOST']]
        : 'production';
});

$_SERVER['MY_LARAVEL_ENV'] = $env;

/*
|--------------------------------------------------------------------------
| Bind Paths
|--------------------------------------------------------------------------
|
| Here we are binding the paths configured in paths.php to the app. You
| should not be changing these here. If you need to change these you
| may do so within the paths.php file and they will be bound here.
|
*/

$app->bindInstallPaths(require __DIR__.'/paths.php');

/*
|--------------------------------------------------------------------------
| Load The Application
|--------------------------------------------------------------------------
|
| Here we will load this Illuminate application. We will keep this in a
| separate location so we can isolate the creation of an application
| from the actual running of the application with a given request.
|
*/

$framework = $app['path.base'].
                 '/vendor/laravel/framework/src';

require $framework.'/Illuminate/Foundation/start.php';

/*
|--------------------------------------------------------------------------
| Load the custom helper
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/
require $app['path.base'].'/app/helpers/common.php';
require $app['path.base'].'/app/helpers/debug.php';
require $app['path.base'].'/app/helpers/language.php';
require $app['path.base'].'/app/helpers/orders.php';
require $app['path.base'].'/app/helpers/url_friendly.php';
require $app['path.base'].'/app/helpers/simages.php';

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
