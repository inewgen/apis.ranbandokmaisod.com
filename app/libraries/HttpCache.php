<?php

class HttpCache
{
    private static $pool_read;
    private static $pool_write;
    private static $cache_driver = false;
    private static $keyCache     = false;
    private static $store_id     = false;
    private static $parameter    = false;
    private static $expireCache  = 3600;

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

                    $driver = new Stash\Driver\Redis($options);
                } elseif ($cache['driver'] == 'memcached') {
                    $options = array();
                    $options['servers'][] = array($cache['memcached'][0]['host'], $cache['memcached'][0]['port']);
                    $driver = new Stash\Driver\Memcache($options);
                } else {
                    $options = array('path' => storage_path() . '/cache');
                    $driver = new Stash\Driver\FileSystem($options);
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

                    $driver = new Stash\Driver\Redis($options);
                } elseif ($cache['driver'] == 'memcached') {
                    $options = array();
                    $options['servers'][] = array($cache['memcached'][0]['host'], $cache['memcached'][0]['port']);
                    $driver = new Stash\Driver\Memcache($options);
                } else {
                    $options = array('path' => storage_path() . '/cache');
                    $driver = new Stash\Driver\FileSystem($options);
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

    public static function get($key, $content = false)
    {
        self::connectRead();

        if (self::$cache_driver == 'array') {
            return false;
        }

        if (self::$store_id) {
            $key = self::$store_id . '/' . $key;
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

    public static function put($key, $content = false)
    {
        self::connectWrite();

        if (self::$cache_driver == 'array') {
            return $content;
        }

        if (self::$store_id) {
            $key = self::$store_id . '/' . $key;
        }

        if (self::$parameter) {
            $key .= '/' . md5(serialize(self::$parameter));
        }

        if ($content) {
            try {
                $item = self::$pool_write->getItem($key);
                $item->set($content, self::$expireCache);
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

        if (self::$store_id) {
            $key = self::$store_id . '/' . $key;
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

    public static function reset()
    {
        self::$store_id = false;
        self::$parameter = false;

        return new static();
    }

    public static function setStoreId($id)
    {
        self::$store_id = $id;

        return new static();
    }

    public static function setParam($var)
    {
        self::$parameter = $var;

        return new static();
    }

    public static function setExpire($seconds = false)
    {
        if ($seconds) {
            self::$expireCache = $seconds;
        }

        return new static();
    }
}
