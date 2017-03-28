<?php

class CacheController extends ApiController
{
    public function clearCache()
    {
        $data = Input::all();
        $response = array();

        // Validator request
        $rules = array(
            'key' => 'required|min:3',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        if ($key_cache = array_get($data, 'key', false)) {
            $get_keys_all = CachedSettings::getKeys();
            $i = 0;

            foreach ($get_keys_all as $key => $value) {
                if (strpos($value, $key_cache) === 0) {
                    $keys[] = $value;
                    if (!CachedSettings::has($value)) {
                        //return API::createResponse($response, 3002);
                    }

                    $clear_cache = clearCache($value);
                    $i++;
                }
            }

            if ($i == 0) {
                return API::createResponse($response, 3002);
            }

            $response = array(
                'message' => 'Success clear cache'
            );
            return API::createResponse($response, 0);
        }

        return API::createResponse($response, 3001);
    }
}
