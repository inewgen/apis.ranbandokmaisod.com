<?php


/**
 * [mksize description]
 * @param  [type] $bytes [description]
 * @return [type]        [description]
 */
if (!function_exists('checkBlockwords')) {
    function checkBlockwords($message = null, $type = null)
    {
        if (!isset($message) || !isset($type)) {
            return false;
        }

        // Get Blockwords
        $filters = array(
            'type' => $type
        );
        $query = Blockwords::filters($filters)
                ->get();
        $results = json_decode($query, true);
        
        if (!$results) {
            $response = array();

            return false;
        }

        // Loop
        foreach ($results as $key => $value) {
            $search = $value['title'];
            $results = strpos($message, $search);
            if ($results > -1) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('replaceBlockwords')) {
    function replaceBlockwords($message, $type = '1', $replace = '***')
    {
        // Get Blockwords
        $filters = array(
            'type' => $type
        );
        $query = Blockwords::filters($filters)
                ->get();
        $results = json_decode($query, true);
        
        if (!$results) {
            $response = array();

            return false;
        }

        // Loop
        foreach ($results as $key => $value) {
            $search = $value['title'];
            $message = str_replace($search, $replace, $message);
        }

        return $message;
    }
}

if (!function_exists('loopImages')) {
    function loopImages($data = array(), $user_id = '', $section = '')
    {
        //Loop images
        $images = array();
        foreach ($data as $key3 => $value3) {
            $w = array_get($value3, 'width', 200);
            if ($w == 0) {
                $w = 200;
            }

            $h = array_get($value3, 'height', 143);
            if ($h == 0) {
                $h = 143;
            }

            if ($section == 'banners') {
                $w = 1163;
                $h = 365;
            }

            $file_name = $value3['code'] . '.' . $value3['extension'];
            $image['id'] = $value3['id'];
            $image['code'] = $value3['code'];
            $image['extension'] = $value3['extension'];
            $image['name'] = $value3['name'];
            $image['width'] = $value3['width'];
            $image['height'] = $value3['height'];
            $image['size'] = $value3['size'];
            $image['url'] = getImageLink('images', $value3['user_id'], $value3['code'], $value3['extension'], $w, $h, $value3['name']);
            $image['position'] = $value3['position'];
            $image['user_id'] = $value3['user_id'];
            $images[] = $image;
        }

        return $images;
    }
}

if (!function_exists('insertImageable')) {
    function insertImageable($image_id = null, $banner_id = null, $section = null)
    {
        if (!isset($image_id) || !isset($banner_id) || !isset($section)) {
            return false;
        }

        // Insert imageables
        $parameters = array(
            'images_id' => $image_id,
            'imageable_id' => $banner_id,
            'imageable_type' => $section,
        );

        $query = new Imageables();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();

        if (!$query) {
            return false;
        }

        return true;
    }
}

if (!function_exists('getImageLink')) {
    // img|image, default|user_id, array(), 100, 100
    function getImageLink($type, $section, $code, $extension, $w, $h, $name = 'ranbandokmaisod.jpg')
    {
        if (empty($type) || empty($section) || empty($code) || empty($extension)) {
            return false;
        }

        $ranbandokmaisod_res = Config::get('url.ranbandokmaisod-res');

        if ($type == 'img') {
            return $ranbandokmaisod_res . '/img/' . $section . '/' . $code . '/' . $extension . '/' . $w . '/' . $h .'/'.$name;
        }
        $user_id = $section;

        return $ranbandokmaisod_res . '/image/' . $user_id . '/' . $code . '/' . $extension . '/' . $w . '/' . $h.'/'.$name;
    }
}

if (!function_exists('getImageProfile')) {
    function getImageProfile($user, $w, $h)
    {
        if (empty($user) || empty($w) || empty($h)) {
            return false;
        }

        $ranbandokmaisod_res = Config::get('url.ranbandokmaisod-res');
        $user_id = $user->id;
        $code = $user->images[0]->code;
        $extension = $user->images[0]->extension;
        $name = 'profile.jpg';

        return $ranbandokmaisod_res . '/image/' . $user_id . '/' . $code . '/' . $extension . '/' . $w . '/' . $h.'/'.$name;
    }
}

if (!function_exists('getLogo')) {
    function getLogo($w, $h)
    {
        if (empty($w) || empty($h)) {
            return false;
        }
        $ranbandokmaisod_res = Config::get('url.ranbandokmaisod-res');
        $name = 'logo.jpg';

        return $ranbandokmaisod_res . '/img/default/ranbandokmaisod_logo/png/' . $w . '/' . $h.'/'.$name;
    }
}

if (!function_exists('getKeyCache')) {
    function getKeyCache($pathcache, $data)
    {
        $data     = array_except($data, 'nocache');
        $keycache = $pathcache . '.' . md5(serialize($data));

        return $keycache;
    }
}

if (!function_exists('saveCache')) {
    function saveCache($keycache, $value_cache)
    {
        return CachedSettings::set($keycache, serialize($value_cache));
    }
}

if (!function_exists('getCache')) {
    function getCache($keycache)
    {   
        return false;
        if (Input::get('nocache')) {
            return false;
        }
        
        $value = false;
        if ($value = CachedSettings::get($keycache, false)) {
            $value = unserialize($value);

            if ($value) {
                $value['cached'] = true;
            }
        }

        return $value;
    }
}

if (!function_exists('clearCache')) {
    function clearCache($keycache)
    {
        if (!empty($keycache)) {
            $get_keys_all = CachedSettings::getKeys();
            $i = 0;

            foreach ($get_keys_all as $key => $value) {
                if (strpos($value, $keycache) === 0) {
                    $keys[] = $value;
                    if (!CachedSettings::has($value)) {
                        //return false;
                    }

                    CachedSettings::delete($value);
                    Cache::forget($value);
                    $i++;
                }
            }

            if ($i == 0) {
                return false;
            }

            return true;
        }

        return false;
    }
}

if (!function_exists('clearCacheStore')) {
    function clearCacheStore($pathcache)
    {
        $keycache = $pathcache . '.index';
        clearCache($keycache);
    }
}

if (!function_exists('clearCacheUpdate')) {
    function clearCacheUpdate($pathcache, $id)
    {
        $keycache = $pathcache . '.index';
        clearCache($keycache);

        $keycache = $pathcache . '.show.' . $id;
        clearCache($keycache);
    }
}

if (!function_exists('clearCacheDestroy')) {
    function clearCacheDestroy($pathcache, $id)
    {
        $keycache = $pathcache . '.index';
        clearCache($keycache);

        $keycache = $pathcache . '.show.' . $id;
        clearCache($keycache);
    }
}
