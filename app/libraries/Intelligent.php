<?php

class Intelligent
{
    protected static $key = "8r0tg3jc4h4oak0gmvogm25be1";

    /**
     * [__construct description]
     */
    public function __construct()
    {

    }

    /**
     * [authenticate description]
     * @return [type] [description]
     */
    public static function authenticateOpenID(array $credentials, $remember = false)
    {
        if (array_get($credentials, 'uid') && array_get($credentials, 'service')) {

            $connect = UserConnect::whereService($credentials['service'])->whereUid($credentials['uid'])->first();
            if (count($connect) == 1) {
                $user = \User::whereId($connect->user_id)->first();
                if ($user) {
                    $config   = \Config::get('session');
                    $keep     = array(
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'first_name' => $user->first_name,
                        'last_name' => $user->first_name,
                        'display_name' => $user->display_name,
                        'time' => time()
                    );

                    // update last login
                    $user = \User::find($user->id);
                    $user->last_login = date('Y-m-d H:i:s');
                    $user->save();

                    $lifetime = ($remember) ? time() + 262800000 : 0;
                    self::setCookie($keep, $lifetime, $config['path'], $config['domain']);

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * [authenticate description]
     * @return [type] [description]
     */
    public static function authenticate(array $credentials, $remember = false)
    {
        if (array_get($credentials, 'user') && array_get($credentials, 'password')) {
            // [1] check login old

            $user = self::loginOld($credentials['user'], $credentials['password']);

            if ($user->status_code == '0') {

                $connect = UserConnect::whereUid($user->data->user->id)->whereService('welove')->first();
                if (count($connect)==0) {
                     $data  = array(
                        'email'=>$credentials['user'],
                        'password'=>$credentials['password'],
                        'first_name'=>$user->data->user->name,
                        'last_name'=>$user->data->user->surname,
                        'display_name'=>$user->data->user->name.' '.$user->data->user->surname,
                        'trueid'=>$user->data->user->sso_id,
                        'id'=>$user->data->user->id,
                        'activate'=>$user->data->user->activate
                     );

                     self::migrationUser($data);
                }

                 $credentials = array(
                    'service'=>'welove',
                    'uid'=>$user->data->user->id
                );
                self::authenticateOpenID($credentials, true);

                return self::createResponse(array(), '0');
            }

            // [2] check login new
            $user = \User::whereEmail($credentials['user'])->first();
            if ($user) {
                if (\Hashing\NativeHasher::checkhash($credentials['password'], $user->password)) {
                    $config   = \Config::get('session');
                    $keep     = array(
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'first_name' => $user->first_name,
                        'last_name' => $user->first_name,
                        'display_name' => $user->display_name,
                        'time' => time()
                    );

                    // update last login
                    $user = \User::find($user->id);
                     $user->last_login = date('Y-m-d H:i:s');
                    $user->save();

                    $lifetime = ($remember) ? time() + 262800000 : 0;
                    self::setCookie($keep, $lifetime, $config['path'], $config['domain']);

                    return self::createResponse(array(), '0');
                }
            }
        }

        $response = array();

        return self::createResponse(array(), '1003');
    }

    /**
     * [loginOld description]
     * @param  [type] $user     [description]
     * @param  [type] $password [description]
     * @return [type] [description]
     */
    public static function loginOld($user, $password)
    {
        $parameters = array(
            'method' => 'login',
            'username' => $user,
            'password' => $password,
            'service' => 'WLS',
            'apikey' => '1234',
            'format' => 'json'
        );

        $url = "http://api.weloveshopping.com/rest/users/";

        $result = self::curl($url, $parameters);

        return json_decode($result)->response;
    }

    /**
     * [check description]
     * @return [type] [description]
     */
    public static function check()
    {
        if (isset($_COOKIE['HSID'])) {
            $user = unserialize(\Hashing\Rc4crypt::decrypt(static::$key, $_COOKIE['HSID']));
            if (isset($user['user_id']) && is_numeric($user['user_id']) && $user['user_id'] > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * [hasAccess description]
     * @return boolean [description]
     */
    public static function getUser()
    {
        if (isset($_COOKIE['HSID'])) {
            $user = unserialize(\Hashing\Rc4crypt::decrypt(static::$key, $_COOKIE['HSID']));
            if (isset($user['user_id']) && is_numeric($user['user_id']) && $user['user_id'] > 0) {
                $fields  = array(
                    'id',
                    'email',
                    'first_name',
                    'last_name',
                    'display_name',
                    'phone',
                    'idcard'
                );
                $profile = User::getById($user['user_id'])->toArray();

                return (object) $profile;
            }
        }

        return false;
    }

    /**
     * [hasAccess description]
     * @return boolean [description]
     */
    public function hasAccess()
    {

    }

    /**
     * [logout description]
     * @return [type] [description]
     */
    public static function logout()
    {
        $config = \Config::get('session');
        self::setCookie(array(), time() - 3600, $config['path'], $config['domain']);

        return true;
    }

    /**
     * Actually sets the cookie.
     *
     * @param  mixed  $value
     * @param  int    $lifetime
     * @param  string $path
     * @param  string $domain
     * @param  bool   $secure
     * @param  bool   $httpOnly
     * @return void
     */
    public static function setCookie($value, $lifetime, $path = null, $domain = null, $secure = null, $httpOnly = null)
    {
        $value = serialize($value);
        $keep  = \Hashing\Rc4crypt::encrypt(static::$key, $value);
        setcookie('HSID', $keep, $lifetime, $path, $domain, $secure, $httpOnly);
    }

    /**
     * [registerWithStore description]
     * @return [type] [description]
     */
    public static function registerStore($data)
    {
        Validator::extend('trueid_exist', function ($attribute, $value, $parameters) {
            $result = \User\Sso::checkEmailExist($value);
            if ($result->result_code == '0') {
                return false;
            }

            return true;
        });

        Validator::extend('olduser_exist', function ($attribute, $value, $parameters) {
            return self::checkOldEmailExist($value);
        });

        Validator::extend('idcard', function ($attribute, $value, $parameters) {
            if (strlen($value) != 13) {
                return false;
            }
            for ($i = 0, $sum = 0; $i < 12; $i++) {
                $sum += (int) ($value{$i}) * (13 - $i);
                if ((11 - ($sum % 11)) % 10 == (int) ($value{12})) {
                    return true;
                }
            }

            return false;
        });

        $rules = array(
            'email' => 'Required|Email|Between:3,64|Unique:users|olduser_exist|trueid_exist',
            'slug' => 'required|alpha_dash|min:3|max:20|Unique:stores',
            'password' => 'Required|AlphaNum|Between:8,16|Confirmed',
            'password_confirmation' => 'Required|AlphaNum|Between:8,16',
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'display_name' => 'Required|min:3|max:50',
            'phone'  =>'min:9|Numeric',
            'idcard' => 'required|idcard',
            'ip' => 'Required|ip',
            's_bank_name'=>'Required',
            's_bank_number'=>'Required|min:3|Numeric',
            's_name'=>'Required|min:3',
            's_category'=>'Required|Numeric',
            's_address1'=>'Required|min:3',
            's_address2'=>'Required|min:3',
            's_postcode'=>'Required|Numeric',
            's_email'=>'Required|Email|Between:3,64',
            's_phone'=>'min:9|Numeric',
            's_zone'=>'Required|Numeric',
            's_country'=>'Required|Numeric',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'errors' => array(
                    'message' => $validator->messages()->first()
                )
            );

            return self::createResponse($response, '1003');
        }

        // [1] Register True ID
        $result = \User\Sso::registerGlobal($data['email'], $data['password'], $data['display_name'], $data['ip']);
        if ($result->result_code!='0') {
            return self::createResponse($response, '1011');
        }

        $trueid = $result->result_data->uid;

        // [2] Register User
        $user        = new \User;
        $user->email = $data['email'];
        isset($data['first_name']) ? $user->first_name = $data['first_name'] : '';
        isset($data['last_name']) ? $user->last_name = $data['last_name'] : '';
        isset($data['display_name']) ? $user->display_name = $data['display_name'] : '';
        isset($data['idcard']) ? $user->idcard = $data['idcard'] : '';
        isset($data['phone']) ? $user->phone = $data['phone'] : '';
        $user->password        = \Hashing\NativeHasher::hash($data['password']);
        $user->activation_code = self::getRandomString();
        if (!$user->save()) {
            return self::createResponse($response, '1012');
        }
        $user_id = $user->id;

        // [3] Add user connect TrueID
        self::addConnect('trueid', $user_id, $trueid, $data['email']);

        // [4] Add user connect facebook if register with facebook
        if (isset($data['facebook_uid'])) {
            self::addConnect('facebook', $user_id, $data['facebook_uid'], $data['email']);
        }

        //[5] Register Store
        $store        = new \Store;
        $store->user_id  = $user_id;
        $store->slug  = $data['slug'];
        $store->email  = $data['email'];
        if (!$store->save()) {
            return self::createResponse($response, '1013');
        }

        return self::createResponse($user->toArray(), '0');
    }

    /**
     * [registerUser description]
     * @param  [type] $data [description]
     * @return [type] [description]
     */
    public static function register($data)
    {
        Validator::extend('trueid_exist', function ($attribute, $value, $parameters) {
            $result = \User\Sso::checkEmailExist($value);
            if ($result->result_code == '0') {
                return false;
            }

            return true;
        });

        Validator::extend('olduser_exist', function ($attribute, $value, $parameters) {
            return self::checkOldEmailExist($value);
        });

        Validator::extend('idcard', function ($attribute, $value, $parameters) {
            if (strlen($value) != 13) {
                return false;
            }
            for ($i = 0, $sum = 0; $i < 12; $i++) {
                $sum += (int) ($value{$i}) * (13 - $i);
                if ((11 - ($sum % 11)) % 10 == (int) ($value{12})) {
                    return true;
                }
            }

            return false;
        });

        $rules = array(
            'email' => 'Required|Between:3,64|Email|Unique:users|olduser_exist|trueid_exist',
            'password' => 'Required|AlphaNum|Between:8,16|Confirmed',
            'password_confirmation' => 'Required|AlphaNum|Between:8,16',
            'first_name' => 'min:3|max:50',
            'last_name' => 'min:3|max:50',
            'display_name' => 'Required|min:3|max:50',
            'phone'       =>'min:9|Numeric',
            'idcard' => 'idcard',
            'ip' => 'Required|ip'
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'errors' => array(
                    'message' => $validator->messages()->first()
                )
            );

            return self::createResponse($response, '1003');
        }

        // [1] Register True ID
        $result = \User\Sso::registerGlobal($data['email'], $data['password'], $data['display_name'], $data['ip']);
        if ($result->result_code!='0') {
            return self::createResponse($response, '1011');
        }

        $trueid = $result->result_data->uid;

        // [2] Register User
        $user        = new \User;
        $user->email = $data['email'];
        isset($data['first_name']) ? $user->first_name = $data['first_name'] : '';
        isset($data['last_name']) ? $user->last_name = $data['last_name'] : '';
        isset($data['display_name']) ? $user->display_name = $data['display_name'] : '';
        isset($data['idcard']) ? $user->idcard = $data['idcard'] : '';
        isset($data['phone']) ? $user->phone = $data['phone'] : '';
        $user->password        = \Hashing\NativeHasher::hash($data['password']);
        $user->activation_code = self::getRandomString();
        if (!$user->save()) {
            return self::createResponse($response, '1012');
        }
        $user_id = $user->id;

        // [3] Add user connect TrueID
        self::addConnect('trueid', $user_id, $trueid, $data['email']);

        // [4] Add user connect facebook if register with facebook
        if (isset($data['facebook_uid'])) {
            self::addConnect('facebook', $user_id, $data['facebook_uid'], $data['email']);
        }

        return self::createResponse($user->toArray(), '0');
    }

    /**
     * [addConnect description]
     * @param [type] $service [description]
     * @param [type] $user_id [description]
     * @param [type] $uid     [description]
     */
    protected static function addConnect($service, $user_id, $uid, $account)
    {
        $connect = new UserConnect();
        $connect->service = $service;
        $connect->account = $account;
        $connect->uid = $uid;
        $connect->user_id = $user_id;

        return $connect->save();
    }

    /**
     * [migrationUser description]
     * @return [type] [description]
     */
    protected static function migrationUser($data)
    {
        $user                  = new \User;
        $user->email           = $data['email'];
        $user->first_name      = $data['first_name'];
        $user->last_name       = $data['last_name'];
        $user->display_name    = $data['display_name'];
        $user->password        = \Hashing\NativeHasher::hash($data['password']);
        $user->activation_code = self::getRandomString();

        if ($data['activate']=='y') {
            $user->activated       = 1;
            $user->activated_at    = date('Y-m-d H:i:s');
            $user->activation_code = null;
        }
        if ($user->save()) {

            $connect = new UserConnect();
            $connect->service = 'welove';
            $connect->account = $data['email'];
            $connect->uid = $data['id'];
            $connect->user_id = $user->id;
            $connect->save();

            if (!empty($data['trueid'])) {
                $connect = new UserConnect();
                $connect->service = 'trueid';
                $connect->account = $data['email'];
                $connect->uid = $data['trueid'];
                $connect->user_id = $user->id;
                $connect->save();
            }

            return true;
        }

        return false;
    }

    /**
     * Get an activation code for the given user.
     *
     * @return string
     */
    public static function getActivationCode($id)
    {
        $user = User::find($id, array(
            'activation_code'
        ));

        return $user->activation_code;
    }

    /**
     * [attemptActivation description]
     * @param  [type] $user_id [description]
     * @param  [type] $code    [description]
     * @return [type] [description]
     */
    public static function attemptActivation($id, $activation_code)
    {
        $user = User::find($id);

        if ($user->activation_code == $activation_code) {
            $user->activated       = 1;
            $user->activation_code = null;
            $user->activated_at    = date('Y-m-d H:i:s');
            $user->save();

            return true;
        }

        return false;
    }

    /**
     * Generate a random string. If your server has
     * @return string
     */
    public static function getRandomString($length = 42)
    {
        // We'll check if the user has OpenSSL installed with PHP. If they do
        // we'll use a better method of getting a random string. Otherwise, we'll
        // fallback to a reasonably reliable method.
        if (function_exists('openssl_random_pseudo_bytes')) {
            // We generate twice as many bytes here because we want to ensure we have
            // enough after we base64 encode it to get the length we need because we
            // take out the "/", "+", and "=" characters.
            $bytes = openssl_random_pseudo_bytes($length * 2);

            // We want to stop execution if the key fails because, well, that is bad.
            if ($bytes === false) {
                throw new \RuntimeException('Unable to generate random string.');
            }

            return substr(str_replace(array(
                '/',
                '+',
                '='
            ), '', base64_encode($bytes)), 0, $length);
        }

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    /**
     * [checkOldEmailExist description]
     * @param  [type] $email [description]
     * @return [type] [description]
     */
    public static function checkOldEmailExist($email)
    {
        $parameters = array(
            'method' => 'checkEmailExist',
            'email' => $email,
            'service' => 'WLS',
            'apikey' => '1234',
            'format' => 'json'
        );

        $url = "http://api.weloveshopping.com/rest/users/";

        $result = self::curl($url, $parameters);

        if (json_decode($result)->response->status_code=='10016') {
            return false;
        }

        return true;
    }

    public static function checkOldEmailMustExist($email)
    {
        $parameters = array(
            'method'    => 'checkEmailExist',
            'email'     => $email,
            'service'   => 'WLS',
            'apikey'    => '1234',
            'format'    => 'json'
        );

        $url = "http://api-02.weloveshopping.com/rest/users/";

        $result = self::curl($url, $parameters);

        $result = json_decode($result);
        $status_code = object_get($result,'response.status_code');

        if ($status_code == '10018') {
            return false;
        }

        return true;
    }

    /**
     * [CURL description]
     * @param [type]  $url     [description]
     * @param [type]  $post    [description]
     * @param integer $timeout [description]
     */
    public static function curl($url, $post = null, $timeout = 10)
    {
        $curl = curl_init($url);
        if (is_resource($curl) === true) {
            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_FAILONERROR, true);
            @curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            if (isset($post) === true) {
                curl_setopt($curl, CURLOPT_POST, true);

                $post = (is_array($post) === true) ? http_build_query($post, '', '&') : $post;
                curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
            }

            $result = curl_exec($curl);
            curl_close($curl);

            return $result;
        }

        return false;
    }

    /**
     * [createResponse description]
     * @return [type] [description]
     */
    public static function createResponse($data, $code)
    {
        $error_code = array(
            '0' => 'Success',
            '1000' => 'Invalid token',
            '1001' => 'Connection error',
            '1002' => 'Invalid api key',
            '1003' => 'Invalid parameter',
            '1004' => 'Data not found',
            '1005' => 'Insert data error',
            '1006' => 'Update data error',
            '1007' => 'Delete data error',
            '1008' => 'Limit quota',
            '1009' => 'Permission denied',
            '1010' => 'Duplicate data',
            '1011' => 'Error register trueid',
            '1012' => 'Error register user',
            '1013' => 'Error Register store'
        );

        $response = array(
            'status_code' => (isset($error_code[$code])) ? $code : "99999",
            'status_txt' => (isset($error_code[$code])) ? $error_code[$code] : "undefined error code",
            'data' =>$data
        );

        $response = json_decode(json_encode($response));

        return $response;
    }
}
