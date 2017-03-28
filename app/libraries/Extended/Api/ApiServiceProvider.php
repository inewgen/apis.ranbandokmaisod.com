<?php namespace Extended\Api;

use Guzzle\Http\Client;
use Illuminate\Foundation\AliasLoader;

use Teepluss\Api\ApiServiceProvider as ApiServiceProviderBase;

class ApiServiceProvider extends ApiServiceProviderBase
{
    /**
     * Bootstrap classes for packages.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('teepluss/api');

        // Auto create app alias with boot method.
        $loader = AliasLoader::getInstance()->alias('API', 'Teepluss\Api\Facades\API');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register providers.
        $this->registerApi();

        // Register commands.
        $this->registerApiCallCommand();

        // Assign commands.
        $this->commands(
            'api.call'
        );
    }

    /**
     * Register Api.
     *
     * @return void
     */
    public function registerApi()
    {
        $this->app['api.request'] = $this->app->share(function($app)
        {
            $remoteClient = new Client();

            return new Api($app['config'], $app['router'], $app['request'], $remoteClient);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('api.request', 'api.call');
    }
}
