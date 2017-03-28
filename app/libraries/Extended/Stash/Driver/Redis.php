<?php

namespace Extended\Stash\Driver;

use Stash\Driver\Redis as RedisBase;

class Redis extends RedisBase
{
    public function getData($key)
    {
        //return unserialize($this->redis->get($this->makeKeyString($key)));
        $data = $this->redis->get($this->makeKeyString($key));
        if ($data) {
            $data = gzdecode($data);
        }

        return igbinary_unserialize($data);
    }

    public function storeData($key, $data, $expiration)
    {
        //$store = serialize(array('data' => $data, 'expiration' => $expiration));
        $store = igbinary_serialize(array('data' => $data, 'expiration' => $expiration));
        $store = gzencode($store, 4);
        if (is_null($expiration)) {
            return $this->redis->setex($this->makeKeyString($key), $store);
        } else {
            $ttl = $expiration - time();

            // Prevent us from even passing a negative ttl'd item to redis,
            // since it will just round up to zero and cache forever.
            if ($ttl < 1) {
                return true;
            }

            return $this->redis->set($this->makeKeyString($key), $store, $ttl);
        }
    }
}
