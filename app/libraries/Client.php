<?php

use Guzzle\Plugin\Async\AsyncPlugin,
    Guzzle\Common\Exception\MultiTransferException;

class Client
{
    private static $base_url;
    private static $debug;

    public function __construct($base_url = false, $options = array())
    {
        self::loadConfig($base_url, $options);
    }

    private static function keyCache($data)
    {
        if (is_array($data) || is_object($data)) {
            return md5(serialize($data));
        } else {
            return md5($data);
        }
    }

    private static function checkCache($key)
    {
        // remove cache
        if (Input::get('remove_cache', false)) {
            self::removeCache($key);
        }

        $data = Cache::get($key);
        if ($data) {
            return $data;
        }

        return false;
    }

    private static function putCache($key, $data)
    {
        return Cache::put($key, $data, '86400');
    }

    private static function removeCache($key)
    {
        return Cache::forget($key);
    }

    public static function defaultConfig()
    {
        self::$base_url = Config::get('api.base_url');
        self::$debug    = Input::get('debug');
    }

    private static function loadConfig($base_url = false, $options = array())
    {
        if ($base_url) {
            self::$base_url = $base_url;
        } else {
            if (!self::$base_url) {
                self::defaultConfig();
            }
        }
    }

    public static function newClient()
    {
        $key_cache = self::keyCache('Client::newClient' . md5(self::$base_url));
        $data = self::checkCache($key_cache);
        if ($data) {
            return $data;
        }

        $options = array(
            'curl.options' => array(
                'body_as_string' => true,
            )
        );

        $client = new \Guzzle\Http\Client(self::$base_url, $options);

        self::putCache($key_cache, $client);

        return $client;
    }

    /**
     * [get description]
     * @param  [type] $uri        [description]
     * @param  [type] $parameters [description]
     * @return [type] [description]
     */
    public static function get($uri, $parameters = array(), $subscriber = array())
    {
        self::loadConfig();

        // check debug for api response
        if (self::$debug) {
            $parameters['debug'] = 1;
        }

        try {
            //Profiler::start('Client::get->' . $uri);

            $client = self::newClient();

            // Plugins
            if (isset($subscriber['async']) && $subscriber['async']) {
                $client->addSubscriber(new AsyncPlugin());
            }

            $request = $client->get($uri, array(), array('query' => $parameters));
            $request->getCurlOptions()->set(CURLOPT_TCP_NODELAY, true);
            $request->getCurlOptions()->set(CURLOPT_VERBOSE, false);
            $request->getQuery()->useUrlEncoding(false);
            $response = $request->send();

            //Profiler::end('Client::get->' . $uri);

            if ($response->isSuccessful()) {
                $info = $response->getInfo();
                $body = $response->getBody();

                if (self::$debug) {
                    alert($response->getInfo());
                }

                return $body;
            }
        } catch (Guzzle\Http\Exception\CurlException $e) {
            //Profiler::end('Client::get->' . $uri);
            return self::make(null, '404');
        } catch (Guzzle\Http\Exception\BadResponseException $e) {
            //Profiler::end('Client::get->' . $uri);

            if (App::environment() == 'production') {
                $log = array(
                        'message' => $e->getMessage(),
                        'url' => $e->getRequest()->getUrl(),
                        'request' => json_encode($e->getRequest()),
                        'response_status' => $e->getResponse()->getStatusCode(),
                        'response' => json_encode($e->getResponse())
                );
                Log::error('Client:BadResponseException', $log);

                return self::make(null, '500');
            } else {
                echo $e->getResponse()->getBody();
                exit();
            }
        }

        return false;
    }

    public static function getParallel($uri, $parameters = array(), $subscriber = array())
    {
        self::loadConfig();

        $client = self::newClient();

        // Plugins
        if (isset($subscriber['async']) && $subscriber['async']) {
            $client->addSubscriber(new AsyncPlugin());
        }

        $load = $client->get($uri, array(), array('query' => $parameters));

        return $load;
    }

    /**
     * [post description]
     * @param  [type] $uri        [description]
     * @param  array  $parameters [description]
     * @return [type] [description]
     */
    public static function post($uri, $parameters = array(), $subscriber = array())
    {
        self::loadConfig();

        // check debug for api response
        if (self::$debug) {
            $parameters['debug'] = 1;
        }

        try {
            // Profiler::start('Client::post->' . $uri);

            $client = self::newClient();

            // Plugins
            if (isset($subscriber['async']) && $subscriber['async']) {
                $client->addSubscriber(new AsyncPlugin());
            }

            $request = $client->post($uri, array(), $parameters);
            $request->getCurlOptions()->set(CURLOPT_TCP_NODELAY, true);
            $request->getCurlOptions()->set(CURLOPT_VERBOSE, false);
            $response = $request->send();

            //Profiler::end('Client::post->' . $uri);

            if ($response->isSuccessful()) {
                $info = $response->getInfo();
                $body = $response->getBody();

                if (isset($parameters['debug']) && $parameters['debug']) {
                    alert($response->getInfo());
                }

                return $body;
            }
        } catch (Guzzle\Http\Exception\CurlException $e) {
            //Profiler::end('Client::post->' . $uri);
            return self::make(null, '404');
        } catch (Guzzle\Http\Exception\BadResponseException $e) {
            //Profiler::end('Client::post->' . $uri);

            if (App::environment() == 'production') {
                $log = array(
                        'message' => $e->getMessage(),
                        'url' => $e->getRequest()->getUrl(),
                        'request' => json_encode($e->getRequest()),
                        'response_status' => $e->getResponse()->getStatusCode(),
                        'response' => json_encode($e->getResponse())
                );
                Log::error('Client:BadResponseException', $log);

                return self::make(null, '500');
            } else {
                echo $e->getResponse()->getBody();
                exit();
            }
        }

        return false;
    }

    /**
     * [put description]
     * @param  [type] $uri        [description]
     * @param  array  $parameters [description]
     * @return [type] [description]
     */
    public static function put($uri, $parameters = array(), $subscriber = array())
    {
        self::loadConfig();

        // check debug for api response
        if (self::$debug) {
            $parameters['debug'] = 1;
        }

        try {
            //Profiler::start('Client::put->' . $uri);

            $client = self::newClient();

            // Plugins
            if (isset($subscriber['async']) && $subscriber['async']) {
                $client->addSubscriber(new AsyncPlugin());
            }

            $request = $client->put($uri, array(), $parameters);
            $request->getCurlOptions()->set(CURLOPT_TCP_NODELAY, true);
            $request->getCurlOptions()->set(CURLOPT_VERBOSE, false);
            $response = $request->send();

            //Profiler::end('Client::put->' . $uri);

            if ($response->isSuccessful()) {
                $info = $response->getInfo();
                $body = $response->getBody();

                if (isset($parameters['debug']) && $parameters['debug']) {
                    alert($response->getInfo());
                }

                return $body;
            }
        } catch (Guzzle\Http\Exception\CurlException $e) {
            //Profiler::end('Client::put->' . $uri);
            return self::make(null, '404');
        } catch (Guzzle\Http\Exception\BadResponseException $e) {
            //Profiler::end('Client::put->' . $uri);

            if (App::environment() == 'production') {
                $log = array(
                        'message' => $e->getMessage(),
                        'url' => $e->getRequest()->getUrl(),
                        'request' => json_encode($e->getRequest()),
                        'response_status' => $e->getResponse()->getStatusCode(),
                        'response' => json_encode($e->getResponse())
                );
                Log::error('Client:BadResponseException', $log);

                return self::make(null, '500');
            } else {
                echo $e->getResponse()->getBody();
                exit();
            }
        }

        return false;
    }

    /**
     * [delete description]
     * @param  [type] $uri        [description]
     * @param  array  $parameters [description]
     * @return [type] [description]
     */
    public static function delete($uri, $parameters = array(), $subscriber = array())
    {
        self::loadConfig();

        // check debug for api response
        if (self::$debug) {
            $parameters['debug'] = 1;
        }

        try {
            $client = self::newClient();

            // Plugins
            if (isset($subscriber['async']) && $subscriber['async']) {
                $client->addSubscriber(new AsyncPlugin());
            }

            $request = $client->delete($uri, array(), $parameters);
            $request->getCurlOptions()->set(CURLOPT_TCP_NODELAY, true);
            $request->getCurlOptions()->set(CURLOPT_VERBOSE, false);
            $response = $request->send();

            if ($response->isSuccessful()) {
                $info = $response->getInfo();
                $body = $response->getBody();

                if (isset($parameters['debug']) && $parameters['debug']) {
                    alert($response->getInfo());
                }

                return $body;
            }
        } catch (Guzzle\Http\Exception\CurlException $e) {
            return self::make(null, '404');
        } catch (Guzzle\Http\Exception\BadResponseException $e) {
            if (App::environment() == 'production') {
                $log = array(
                        'message' => $e->getMessage(),
                        'url' => $e->getRequest()->getUrl(),
                        'request' => json_encode($e->getRequest()),
                        'response_status' => $e->getResponse()->getStatusCode(),
                        'response' => json_encode($e->getResponse())
                );
                Log::error('Client:BadResponseException', $log);
            } else {
                echo $e->getResponse()->getBody();
                exit();
            }

            return self::make(null, '500');
        }

        return false;
    }

    /**
     * [patch description]
     * @param  [type] $uri        [description]
     * @param  array  $parameters [description]
     * @return [type] [description]
     */
    public static function patch($uri, $parameters = array(), $subscriber = array())
    {
        self::loadConfig();

        // check debug for api response
        if (self::$debug) {
            $parameters['debug'] = 1;
        }

        try {
            $client = self::newClient();

            // Plugins
            if (isset($subscriber['async']) && $subscriber['async']) {
                $client->addSubscriber(new AsyncPlugin());
            }

            $request = $client->patch($uri, array(), $parameters);
            $request->getCurlOptions()->set(CURLOPT_TCP_NODELAY, true);
            $request->getCurlOptions()->set(CURLOPT_VERBOSE, false);
            $response = $request->send();

            if ($response->isSuccessful()) {
                $info = $response->getInfo();
                $body = $response->getBody();

                if (isset($parameters['debug']) && $parameters['debug']) {
                    alert($response->getInfo());
                }

                return $body;
            }
        } catch (Guzzle\Http\Exception\CurlException $e) {
            return self::make(null, '404');
        } catch (Guzzle\Http\Exception\BadResponseException $e) {
            if (App::environment() == 'production') {
                $log = array(
                        'message' => $e->getMessage(),
                        'url' => $e->getRequest()->getUrl(),
                        'request' => json_encode($e->getRequest()),
                        'response_status' => $e->getResponse()->getStatusCode(),
                        'response' => json_encode($e->getResponse())
                );
                Log::error('Client:BadResponseException', $log);

                return self::make(null, '500');
            } else {
                echo $e->getResponse()->getBody();
                exit();
            }
        }

        return false;
    }

    /**
     * [head description]
     * @param  [type] $uri        [description]
     * @param  array  $parameters [description]
     * @return [type] [description]
     */
    public static function head($uri, $parameters = array())
    {
        self::loadConfig();

        // check debug for api response
        if (self::$debug) {
            $parameters['debug'] = 1;
        }

        try {
            $client = self::newClient();
            $request = $client->head($uri, array(), array('query' => $parameters));
            $request->getCurlOptions()->set(CURLOPT_TCP_NODELAY, true);
            $request->getCurlOptions()->set(CURLOPT_VERBOSE, false);
            $response = $request->send();

            if ($response->isSuccessful()) {
                $info = $response->getInfo();
                $body = $response->getBody();

                if (isset($parameters['debug']) && $parameters['debug']) {
                    alert($response->getInfo());
                }

                return $body;
            }
        } catch (Guzzle\Http\Exception\CurlException $e) {
            return self::make(null, '404');
        } catch (Guzzle\Http\Exception\BadResponseException $e) {
            if (App::environment() == 'production') {
                $log = array(
                        'message' => $e->getMessage(),
                        'url' => $e->getRequest()->getUrl(),
                        'request' => json_encode($e->getRequest()),
                        'response_status' => $e->getResponse()->getStatusCode(),
                        'response' => json_encode($e->getResponse())
                );
                Log::error('Client:BadResponseException', $log);

                return self::make(null, '500');
            } else {
                echo $e->getResponse()->getBody();
                exit();
            }
        }

        return false;
    }

    public static function test()
    {
        self::loadConfig();

        //Profiler::start('Client::test');

        $client =  new \Guzzle\Http\Client('http://dev-api.weloveshopping.com/');

        $request = $client->get('', array());
        $request->getCurlOptions()->set(CURLOPT_TCP_NODELAY, true);
        $request->getCurlOptions()->set(CURLOPT_VERBOSE, false);
        $response = $request->send();

        //Profiler::end('Client::test');

        if ($response->isSuccessful()) {
            $info = $response->getInfo();
            $body = $response->getBody();

            if (self::$debug) {
                var_dump($info);
            }

            return $body;
        }

        return false;
    }

    public static function loadParallel($group = false, $keys = false)
    {
        self::loadConfig();

        $client = self::newClient();

        $load = false;
        $parallel_autoload = Config::get('parallel/autoload');

        if ($group) {
            $parallel_group = Config::get('parallel/group');

            if (isset($parallel_group[$group]['load_config'])) {
                $load_config = $parallel_group[$group]['load_config'];
                $parallel = Config::get('parallel/' . $load_config);
            }

            if (isset($parallel_group[$group]['autoload'])) {
                if (is_array($parallel_group[$group]['autoload'])) {
                    $_parallel_autoload = false;
                    foreach ($parallel_group[$group]['autoload'] as $v) {
                        if (isset($parallel_autoload[$v])) {
                            $_parallel_autoload[$v] = $parallel_autoload[$v];
                        }
                    }

                    if ($_parallel_autoload) {
                        $parallel_autoload = $_parallel_autoload;
                    }
                } elseif ($parallel_group[$group]['autoload'] === false) {
                    $parallel_autoload = false;
                }
            }
        }

        if (isset($parallel_autoload) && is_array($parallel_autoload)) {
            foreach ($parallel_autoload as $key => $config) {
                if (isset($config['request'])) {
                    $req = $config['request'];

                    if (isset($config['parameters']['fields']) && is_array($config['parameters']['fields'])) {
                        $config['parameters']['fields'] = implode(',', $config['parameters']['fields']);
                    }

                    if (isset($config['base_url'])) {
                        $_client = $client;
                        $client = new \Guzzle\Http\Client($config['base_url']);
                    }

                    if ($req == 'get') {
                        $load[$key] = $client->get($config['path'], array(), array('query' => $config['parameters']));
                    } else {
                        $load[$key] = $client->$req($config['path'], array(), $config['parameters']);
                    }

                    if (isset($config['base_url'])) {
                        $client = $_client;
                    }
                }
            }
        }

        // match route
        if (isset($parallel) && is_array($parallel)) {
            $escaped_fragment = Input::get('_escaped_fragment_', false);
            if ($escaped_fragment) {
                $req_path = '/' . trim($escaped_fragment, '/') . '/';
            } else {
                $req_path = '/' . trim(Request::path(), '/') . '/';
            }

            $url      = App::make('Url');
            $req_path = str_replace('/' . $url->lang . '/', '', $req_path);
            $req_path = '/' . trim($req_path, '/') . '/';

            foreach ($parallel as $key => $config) {
                if (isset($config['pattern_url'])) {
                    if (is_array($config['pattern_url'])) {
                        foreach ($config['pattern_url'] as $v) {
                            $path_check = '/' . trim($v, '/') . '/';
                            //echo $path_check . ' = ' . $req_path . '<br />';
                            $pattern = Pattern::create($path_check)->match($req_path);
                            if ($pattern) {
                                break;
                            }
                        }
                    } else {
                        $path_check = '/' . trim($config['pattern_url'], '/') . '/';
                        $pattern    = Pattern::create($path_check)->match($req_path);
                    }

                    if ($pattern) {
                        if (isset($config['request'])) {
                            $req = $config['request'];

                            if (isset($config['parameters']['fields']) && is_array($config['parameters']['fields'])) {
                                $config['parameters']['fields'] = implode(',', $config['parameters']['fields']);
                            }

                            if (isset($config['base_url'])) {
                                $_client = $client;
                                $client = new \Guzzle\Http\Client($config['base_url']);
                            }

                            if ($req == 'get') {
                                $request = $client->get($config['path'], array(), array('query' => $config['parameters']));
                                $request->getQuery()->useUrlEncoding(false);
                                $load[$key] = $request;
                            } else {
                                $load[$key] = $client->$req($config['path'], array(), $config['parameters']);
                            }

                            if (isset($config['base_url'])) {
                                $client = $_client;
                            }
                        }
                    }
                }
            }
        }
        //exit();

        // manual load
        if (isset($keys) && is_array($keys)) {
            foreach ($keys as $key) {
                if (isset($parallel[$key])) {
                    $config = $parallel[$key];
                    if (isset($config['request'])) {
                        $req = $config['request'];

                        if (isset($config['parameters']['fields']) && is_array($config['parameters']['fields'])) {
                            $config['parameters']['fields'] = implode(',', $config['parameters']['fields']);
                        }

                        if (isset($config['base_url'])) {
                            $_client = $client;
                            $client = new \Guzzle\Http\Client($config['base_url']);
                        }

                        if ($req == 'get') {
                            $request = $client->get($config['path'], array(), array('query' => $config['parameters']));
                            $request->getQuery()->useUrlEncoding(false);
                            $load[$key] = $request;
                        } else {
                            $load[$key] = $client->$req($config['path'], array(), $config['parameters']);
                        }

                        if (isset($config['base_url'])) {
                            $client = $_client;
                        }
                    }
                }
            }
        }

        if ($load) {
            return self::execParallel($load);
        }

        return false;
    }

    public static function execParallel($muti)
    {
        self::loadConfig();

        $options = array(
            'curl.options' => array(
                'body_as_string' => true,
            )
        );

        $client = self::newClient();

        try {
            //Profiler::start('Client::parallel');

            $responses = $client->send($muti);
            $_responses = array();
            $i = 0;

            foreach ($muti as $key => $value) {
                $_responses[$key] = $responses[$i]->getBody();

                if (self::$debug) {
                    if (isset($responses[$i])) {
                        alert($responses[$i]->getInfo());
                    }
                }

                $i++;
            }

            //Profiler::end('Client::parallel');
            return $_responses;
        } catch (MultiTransferException $e) {
            //Profiler::end('Client::parallel');

            echo "The following exceptions were encountered:\n";
            foreach ($e as $exception) {
                echo $exception->getMessage() . "\n";
            }

            echo "The following requests failed:\n";
            foreach ($e->getFailedRequests() as $request) {
                echo $request . "\n\n";
            }

            echo "The following requests succeeded:\n";
            foreach ($e->getSuccessfulRequests() as $request) {
                echo $request . "\n\n";
            }
        }
    }

    /**
     * Create API response.
     *
     * @param  mixed   $messages
     * @param  integer $code
     * @return string
     */
    public static function createResponse($messages, $code = 200)
    {
        return self::make($messages, $code);
    }

       /**
     * Make json data format.
     *
     * @param  mixed   $data
     * @param  integer $code
     * @param  boolean $overwrite
     * @return string
     */
    public static function make($data, $code, $overwrite = false)
    {
        // Status returned.
        $status = (preg_match('/^2/', $code)) ? 'success' : 'error';

        // Change object to array.
        if (is_object($data)) {
            $data = $data->toArray();
        }

        if ($overwrite === true) {
            $response = $data;
        } else {

            $error_code = \Config::get('api.error_code');

            // Available data response.
            $response = array(
                'status_code' => (isset($error_code[$code])) ? $code : "99999",
                'status_txt' => (isset($error_code[$code])) ? $error_code[$code] : "undefined error code",
                'data'       => $data,
                'pagination' => null
            );

            // Merge if data has anything else.
            if (is_array($data) and isset($data['data'])) {
                $response = array_merge($response, $data);
            }

            // Remove empty array.
            $response = array_filter($response, function ($value) {
                return ! is_null($value);
            });
        }

        // Always return 200 header.
        return \Response::json($response, 200);
    }
}
