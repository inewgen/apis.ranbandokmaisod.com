<?php namespace Extended\Api;

use Teepluss\Api\Api as ApiBase;

class Api extends ApiBase
{
    public function hello()
    {
        echo 'Hello';
    }

           /**
     * Make json data format.
     *
     * @param  mixed   $data
     * @param  integer $code
     * @param  boolean $overwrite
     * @return string
     */
    public function make($data, $code, $overwrite = false)
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
                'status_code' => (isset($error_code[$code]))?$code:"99999",
                'status_txt' => (isset($error_code[$code]))?$error_code[$code]:"undefined error code",
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
