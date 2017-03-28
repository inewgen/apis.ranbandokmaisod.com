<?php

class StashCache
{
    private static $pool_read;
    private static $pool_write;
    private static $cache_driver = false;
    private static $keyCache     = false;
    private static $parameter    = false;
    private static $expireCache  = 86400;

    public function __construct()
    {

    }

    public static function connectRead()
    {
        if (!self::$pool_read) {
            $cache = Config::get('cache');

            self::$cache_driver = $cache['driver'];

            try {
                if ($cache['driver'] == 'redis') {
                    $db = Config::get('database.redis.read');

                    // ping
                    $redis = new Redis();
                    $ping = $redis->connect($db['host'], $db['port'], 1, null, 100);
                    if ($ping) {
                        try {
                            $redis->ping();
                        } catch (Exception $e) {
                            self::$cache_driver = 'array';

                            return self::$pool_read;
                        }
                    } else {
                        self::$cache_driver = 'array';

                        return self::$pool_read;
                    }

                    $servers[] = array(
                        'server' => $db['host'],
                        'port'   => $db['port'],
                        'ttl'    => 2
                    );

                    $options['servers']  = $servers;
                    $options['database'] = $db['database'];

                    if (isset($db['password'])) {
                        $options['password'] = $db['password'];
                    }

                    $driver = new Extended\Stash\Driver\Redis();
                    $driver->setOptions($options);
                } elseif ($cache['driver'] == 'memcached') {
                    $options = array();
                    $options['servers'][] = array($cache['memcached'][0]['host'], $cache['memcached'][0]['port']);
                    $driver = new Stash\Driver\Memcache();
                    $driver->setOptions($options);
                } else {
                    $options = array('path' => storage_path() . '/cache');
                    $driver = new Stash\Driver\FileSystem();
                    $driver->setOptions($options);
                }

                self::$pool_read = new Stash\Pool($driver);
            } catch (Exception $e) {
                $driver = false;
                self::$cache_driver = 'array';
                Log::error($e);

                return false;
            }
        }

        return self::$pool_read;
    }

    public static function connectWrite()
    {

        if (!self::$pool_write) {
            $cache = Config::get('cache');

            self::$cache_driver = $cache['driver'];

            try {
                if ($cache['driver'] == 'redis') {
                    $db = Config::get('database.redis.write');

                    // ping
                    $redis = new Redis();
                    $ping = $redis->connect($db['host'], $db['port'], 1, null, 100);
                    if ($ping) {
                        try {
                            $redis->ping();
                        } catch (Exception $e) {
                            self::$cache_driver = 'array';

                            return self::$pool_write;
                        }
                    } else {
                        self::$cache_driver = 'array';

                        return self::$pool_write;
                    }

                    $servers[] = array(
                        'server' => $db['host'],
                        'port'   => $db['port'],
                        'ttl'    => 5
                    );

                    $options['servers']  = $servers;
                    $options['database'] = $db['database'];

                    if (isset($db['password'])) {
                        $options['password'] = $db['password'];
                    }

                    $driver = new Extended\Stash\Driver\Redis();
                    $driver->setOptions($options);
                } elseif ($cache['driver'] == 'memcached') {
                    $options = array();
                    $options['servers'][] = array($cache['memcached'][0]['host'], $cache['memcached'][0]['port']);
                    $driver = new Stash\Driver\Memcache();
                    $driver->setOptions($options);
                } else {
                    $options = array('path' => storage_path() . '/cache');
                    $driver = new Stash\Driver\FileSystem();
                    $driver->setOptions($options);
                }

                self::$pool_write = new Stash\Pool($driver);
            } catch (Exception $e) {
                $driver = false;
                self::$cache_driver = 'array';
                Log::error($e);
            }
        }

        return self::$pool_write;
    }

    public static function get($key)
    {
        self::connectRead();

        if (self::$cache_driver == 'array') {
            return false;
        }

        if (self::$parameter) {
            $key .= '/' . md5(serialize(self::$parameter));
        }

        self::$keyCache = $key;

        try {
            $item = self::$pool_read->getItem($key);
            $data = $item->get();
        } catch (Exception $e) {
            $data = false;
            Log::error($e);
        }

        if ($data) {
            return $data;
        }

        return false;
    }

    public static function has($key)
    {
        self::connectRead();

        if (self::$cache_driver == 'array') {
            return false;
        }

        if (self::$parameter) {
            $key .= '/' . md5(serialize(self::$parameter));
        }

        try {
            $item = self::$pool_read->getItem($key);
            if ($item->isMiss()) {
                return false;
            }
        } catch (Exception $e) {
            Log::error($e);
        }

        return true;
    }

    public static function put($key, $content = false, $expire = '')
    {
        self::connectWrite();

        if (self::$cache_driver == 'array') {
            return $content;
        }

        if (self::$parameter) {
            $key .= '/' . md5(serialize(self::$parameter));
        }

        if ($content) {
            try {
                $item = self::$pool_write->getItem($key);
                $item->lock();
                if (!empty($expire)) {
                    $expire = $expire;
                } else {
                    $expire = self::$expireCache;
                }

                $item->set($content, $expire);
            } catch (Exception $e) {
                Log::error($e);
            }

            return $content;
        }

        return false;
    }

    public static function clear($key)
    {
        self::connectWrite();

        if (self::$cache_driver == 'array') {
            return false;
        }

        if (self::$parameter) {
            $key .= '/' . md5(serialize(self::$parameter));
        }

        try {
            $item = self::$pool_write->getItem($key);

            return $item->clear();
        } catch (Exception $e) {
            Log::error($e);
        }

        return false;
    }

    public static function setExpire($seconds = false)
    {
        if ($seconds) {
            self::$expireCache = $seconds;
        }

        return new static();
    }

    public static function setExpireForever()
    {
        self::$expireCache = 86400 * 90;

        return new static();
    }

    public static function setParam($var)
    {
        self::$parameter = $var;

        return new static();
    }

    public static function page($url = false)
    {
        if (!array_key_exists(App::environment(), array('local' => 1, 'dev' => 1))) {
            if (!$url) {
                return;
            }

            $url = trim($url);

            $symbol = '&';
            if (strstr($url, '?') === false) {
                $symbol = '?';
            }

            $params = array(
                'queue' => 'page_cache',
                'class' => 'PageCacheTask',
                'args'  => array('url' => $url . $symbol .  'refresh=changeme')
            );

            Client::post(Config::get('api.q_url'), $params, array('async' => 1));
        }
    }
}
