<?php namespace User;

/**
 *  True Life Single Sign On
 *
 * Created on 12/11/2010
 * Updated on 29/05/2012
 * @package SSO
 * @author [Kritsanun Nuntasen] <[recordset@gmail.com]>
 * @version Version 2.1
 */

class Sso
{
    protected static $app_id = "12";
    protected static $secret = "d87ef361b434690b04a2326cff7219d8";

    protected static $url_auth = "https://auth-platform.truelife.com";
    protected static $url_profile = "https://profile-platform.truelife.com";
    protected static $url_member = "https://memberservice.truelife.com/api/proxyAPI.php";

    protected static $debug = false;

    /*
    http://profile.platform.truelife.com/16/avatar?key=1&w=25&h=25

    http://image.platform.truelife.com/16/avatar?key=1&w=25&h=25
     */

    public function __construct()
    {

    }

    /**
     * [registerTrueCard description]
     * @param  [type] $username [description]
     * @param  [type] $password [description]
     * @param  [type] $thaiid   [description]
     * @param  [type] $email    [description]
     * @param  string $language [description]
     * @return [type] [description]
     */
    public static function registerTrueCard($username, $password, $thaiid, $email, $language = 'th')
    {
        $apiKey = "9ae438a7c441a132c698c6389b95ad72";
        $url    = "http://new.truelife.com/api/profile/rest/?method=registerAll&app_id=" . static::$app_id . "&secretKey=" . static::$secret . "&apiKey=$apiKey&username=" . $username . "&password=" . $password . "&display_name=" . $username . "&language=" . $language . "&thaiid=" . $thaiid . "&cemail=" . $email . "&carrier=&format=json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 29);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);

        if ($result == null || $result == '') {
            $result = substr(trim($result), 3);
            $result = json_decode($result);
        }

        $response = (object) $response;
        if ($result->response->header->code == 200) {
            $response->result_code               = 0;
            $response->result_desc               = 'Success';
            $response->result_data->uid          = $result->response->profile->sso_uid;
            $response->result_data->access_token = $result->response->profile->sso_access_token;
            $response->result_data->expires      = $result->response->profile->sso_expires;
        } else {
            $response->result_code = 1000;
            $response->result_desc = $result->response->header->description;
            $response->result_data = '';
        }

        return $response;
    }

    /**
     * [registerGlobal description]
     * @param  [type] $email              [description]
     * @param  [type] $password           [description]
     * @param  [type] $display_name       [description]
     * @param  [type] $ip                 [description]
     * @param  string $device             [description]
     * @param  string $gender             [description]
     * @param  string $birthday           [description]
     * @param  string $register_longitude [description]
     * @param  string $register_latitude  [description]
     * @return [type] [description]
     */
    public static function registerGlobal($email, $password, $display_name, $ip, $device = '', $gender = '', $birthday = '', $long = '', $lat = '')
    {
        $param = array(
            'method' => 'registerGlobal',
            'email' => $email,
            'password' => base64_encode($password),
            'display_name' => $display_name,
            'gender' => $gender,
            'birthday' => $birthday,
            'ip' => $ip,
            'register_longitude' => $long,
            'register_latitude' => $lat,
            'app_id' => static::$app_id,
            'secret' => static::$secret
        );

        $result = self::CURL(static::$url_member, $param);

        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
            $result->result_data = @$result->result_data;
        } else {
            $result->result_data = @$result->result_data->dataReturn;
        }

        return $result;
    }

    /**
     * [loginAll description]
     * @param  [type] $account  [description]
     * @param  [type] $password [description]
     * @param  [type] $ip       [description]
     * @param  string $rm       [description]
     * @param  string $device   [description]
     * @param  string $type     [description]
     * @return [type] [description]
     */
    public static function loginAll($account, $password, $ip, $rm = '0', $device = '', $type = 'web')
    {
        $param = array(
            'method' => 'loginAll',
            'account' => $account,
            'password' => base64_encode($password),
            'rm' => $rm,
            'ip' => $ip,
            'device' => $device,
            'app_id' => static::$app_id,
            'secret' => static::$secret,
            'l'=>'th',
            'type' => $type
        );

        $result = self::CURL(static::$url_member, $param, 20);

        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = $result->result_data->dataReturn->error->code == '' ? 1000 : $result->result_data->dataReturn->error->code;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [login description]
     * @param  [type] $email    [description]
     * @param  [type] $password [description]
     * @param  [type] $ip       [description]
     * @param  string $rm       [description]
     * @param  string $device   [description]
     * @param  string $type     [description]
     * @return [type] [description]
     */
    public static function login($email, $password, $ip, $rm = '0', $device = '', $type = 'web')
    {
        $param = array(
            'method' => 'login',
            'email' => $email,
            'password' => base64_encode($password),
            'rm' => $rm,
            'ip' => $ip,
            'device' => $device,
            'app_id' => static::$app_id,
            'secret' => static::$secret,
            'type' => $type
        );

        $result = self::CURL(static::$url_member, $param, 10);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [loginMobilePassword description]
     * @param  [type] $mobile   [description]
     * @param  [type] $password [description]
     * @param  [type] $ip       [description]
     * @return [type] [description]
     */
    public static function loginMobilePassword($mobile, $password, $ip)
    {
        $param = array(
            'method' => 'loginMobilePassword',
            'mobile' => $mobile,
            'password' => base64_encode($password),
            'ip' => $ip,
            'app_id' => static::$app_id,
            'secret' => static::$secret
        );

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [registerMobilePassword description]
     * @param  [type] $mobile   [description]
     * @param  [type] $password [description]
     * @param  [type] $ip       [description]
     * @return [type] [description]
     */
    public static function registerMobilePassword($mobile, $password, $ip)
    {
        $param = array(
            'method' => 'registerMobilePassword',
            'mobile' => $mobile,
            'password' => base64_encode($password),
            'ip' => $ip,
            'app_id' => static::$app_id,
            'secret' => static::$secret
        );

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [updateProfileByUid description]
     * @param  [type] $uid                 [description]
     * @param  [type] $access_token        [description]
     * @param  [type] $ip                  [description]
     * @param  string $first_name          [description]
     * @param  string $last_name           [description]
     * @param  string $display_name        [description]
     * @param  string $gender              [description]
     * @param  string $birthday            [description]
     * @param  string $mobile              [description]
     * @param  string $preference          [description]
     * @param  string $device              [description]
     * @param  string $register_longitude  [description]
     * @param  string $register_latitude   [description]
     * @param  string $work                [description]
     * @param  string $education           [description]
     * @param  string $website             [description]
     * @param  string $hometown            [description]
     * @param  string $location            [description]
     * @param  string $bio                 [description]
     * @param  string $qoutes              [description]
     * @param  string $interested_id       [description]
     * @param  string $meeting_for         [description]
     * @param  string $relationship_status [description]
     * @param  string $religion            [description]
     * @param  string $poligion            [description]
     * @return [type] [description]
     */
    public static function updateProfileByUid($uid, $access_token, $ip, $first_name = '', $last_name = '', $display_name = '', $gender = '', $birthday = '', $mobile = '', $preference = '', $device = '', $register_longitude = '', $register_latitude = '', $work = '', $education = '', $website = '', $hometown = '', $location = '', $bio = '', $qoutes = '', $interested_id = '', $meeting_for = '', $relationship_status = '', $religion = '', $poligion = '')
    {
        $param = array(
            'method' => 'updateProfileByUid',
            'access_token' => $access_token,
            'ip' => $ip,
            'uid' => $uid
        );

        !empty($first_name) ? $param['first_name'] = $first_name : '';
        !empty($last_name) ? $param['last_name'] = $last_name : '';
        !empty($gender) ? $param['gender'] = $gender : '';
        !empty($birthday) ? $param['birthday'] = $birthday : '';
        !empty($display_name) ? $param['display_name'] = $display_name : '';
        !empty($mobile) ? $param['mobile'] = $mobile : '';
        !empty($preference) ? $param['preference'] = $preference : '';
        !empty($device) ? $param['device'] = $device : '';
        !empty($register_longitude) ? $param['register_longitude'] = $register_longitude : '';
        !empty($register_latitude) ? $param['register_latitude'] = $register_latitude : '';
        !empty($work) ? $param['work'] = $work : '';
        !empty($education) ? $param['education'] = $education : '';
        !empty($website) ? $param['website'] = $website : '';
        !empty($hometown) ? $param['hometown'] = $hometown : '';
        !empty($location) ? $param['location'] = $location : '';
        !empty($bio) ? $param['bio'] = $bio : '';
        !empty($qoutes) ? $param['qoutes'] = $qoutes : '';
        !empty($interested_id) ? $param['interested_id'] = $interested_id : '';
        !empty($meeting_for) ? $param['meeting_for'] = $meeting_for : '';
        !empty($relationship_status) ? $param['relationship_status'] = $relationship_status : '';
        !empty($religion) ? $param['religion'] = $religion : '';
        !empty($poligion) ? $param['poligion'] = $poligion : '';

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }

        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [validAccessToken description]
     * @param  [type] $access_token [description]
     * @return [type] [description]
     */
    public static function validAccessToken($access_token)
    {
        $param = array(
            'method' => 'validAccessToken',
            'access_token' => $access_token
        );

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [addAuth description]
     * @param [type] $email [description]
     * @param [type] $uid   [description]
     */
    public static function addAuth($email, $uid)
    {
        $param = array(
            'method' => 'addAuth',
            'email' => $email,
            'uid' => $uid,
            'app_id' => static::$app_id,
            'secret' => static::$secret
        );

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [disableUser description]
     * @param  [type] $uid             [description]
     * @param  [type] $email_or_mobile [description]
     * @return [type] [description]
     */
    public static function disableUser($uid, $email_or_mobile)
    {
        $param = array(
            'method' => 'disableUser',
            'uid' => $uid,
            'date' => date('Y-m-d H:i:s'),
            'app_id' => static::$app_id,
            'secret' => static::$secret
        );

        if (eregi('@', $email_or_mobile)) {
            $param['email'] = $email_or_mobile;
        } else {
            $param['mobile'] = $email_or_mobile;
        }

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [verifyUser description]
     * @param  [type] $email [description]
     * @param  [type] $uid   [description]
     * @return [type] [description]
     */
    public static function verifyUser($email, $uid)
    {
        $param = array(
            'method' => 'verifyUser',
            'email' => $email,
            'uid' => $uid,
            'app_id' => static::$app_id,
            'secret' => static::$secret
        );

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [bindingUser description]
     * @param  [type] $email [description]
     * @param  [type] $uid   [description]
     * @return [type] [description]
     */
    public static function bindingUser($email, $uid)
    {
        $param = array(
            'method' => 'bindingUser',
            'email' => $email,
            'uid' => $uid,
            'app_id' => static::$app_id,
            'secret' => static::$secret
        );

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [checkMobileExist description]
     * @param  [type] $mobile [description]
     * @return [type] [description]
     */
    public static function checkMobileExist($mobile)
    {
        $param = array(
            'method' => 'checkMobileExist',
            'mobile' => $mobile,
            'app_id' => static::$app_id,
            'secret' => static::$secret
        );

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error) || !isset($result->result_data->dataReturn->uid)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [updatePasswordByUid description]
     * @param  [type] $uid             [description]
     * @param  [type] $old_password    [description]
     * @param  [type] $new_password    [description]
     * @param  string $email_or_mobile [description]
     * @return [type] [description]
     */
    public static function updatePasswordByUid($uid, $old_password, $new_password, $email_or_mobile = '')
    {
        $param = array(
            'method' => 'updatePasswordByUid',
            'uid' => $uid,
            'old_password' => base64_encode($old_password),
            'new_password' => base64_encode($new_password),
            'app_id' => static::$app_id,
            'secret' => static::$secret
        );

        if (preg_match('/@/', $email_or_mobile)) {
            $param['email'] = $email_or_mobile;
        } else {
            $param['mobile'] = $email_or_mobile;
        }

        $result = self::CURL(static::$url_member, $param, 100);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;
        //alert($result);exit;
        return $result;
    }

    /**
     * [getUserByAccessToken description]
     * @param  [type] $access_token [description]
     * @return [type] [description]
     */
    public static function getUserByAccessToken($access_token)
    {
        $url    = static::$url_profile . "/me?access_token=$access_token";
        $result = self::CURL($url);
        if (isset($result->result_data->error)) {
            $result->result_code = $result->result_data->error->code;
            $result->result_desc = $result->result_data->error->message;
        }
        $result->result_data = @$result->result_data;

        return $result;
    }

    /**
     * [forgotPasswordAll description]
     * @param  [type] $username [description]
     * @param  string $language [description]
     * @return [type] [description]
     */
    public static function forgotPasswordAll($username, $language = 'th')
    {
        $url = 'http://new.truelife.com/api/profile/rest?username=' . $username . '&method=forgotPasswordAll&apiKey=9ae438a7c441a132c698c6389b95ad72&language=' . $language . '&format=json';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 29);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $response=array();
        if ($result) {
            $result = json_decode($result);
            if ($result->response->header->code == '200') {
                $response['result_code'] = 0;
                $response['result_desc'] = 'Success';
                $response['result_data'] = '';
            } else {
                $response['result_code'] = 1000;
                $response['result_desc'] = $result->response->header->description;
                $response['result_data'] = '';
            }
        } else {
            $response['result_code'] = 1000;
            $response['result_desc'] = 'Fail';
            $response['result_data'] = '';
        }

        return json_decode(json_encode($response));
    }

    /**
     * [getAccessTokenInfo description]
     * @param  [type] $access_token [description]
     * @return [type] [description]
     */
    public static function getAccessTokenInfo($access_token)
    {
        $url    = static::$url_auth . "/accesstoken/info?access_token=$access_token&app_id=" . static::$app_id . "&secret=" . static::$secret;
        //$url ="http://dev.profile.platform.truelife.com/me?access_token=$access_token";
        $result = self::CURL($url);

        if (isset($result->result_data->error)) {
            $result->result_code = $result->result_data->error->code;
            $result->result_desc = $result->result_data->error->message;
        }
        $result->result_data = @$result->result_data;

        return $result;
    }

    /**
     * [getUserByID description]
     * @param  [type] $uid [description]
     * @return [type] [description]
     */
    public static function getUserByID($uid)
    {
        $url = static::$url_profile . '/' . $uid;

        return self::CURL($url);
    }

    /**
     * [genCodeResetPassword description]
     * @param  [type] $email [description]
     * @return [type] [description]
     */
    public static function genCodeResetPassword($email)
    {
        $param = array(
            'method' => 'genCodeResetPassword',
            'email' => $email
        );

        $result = self::CURL(static::$url_member, $param);
        if ($result->result_data->dataReturn->status == '1') {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * [getCodeResetPassword description]
     * @param  [type] $email [description]
     * @return [type] [description]
     */
    public static function getCodeResetPassword($email)
    {
        $param = array(
            'method' => 'getCodeResetPassword',
            'email' => $email
        );

        $result = self::CURL(static::$url_member, $param);
        if ($result->result_data->dataReturn->status == '1') {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for  remove code reset password
     *
     * @param  string $key
     * @return object
     * @access public
     */
    public static function removeCodeResetPassword($key)
    {
        $param = array(
            'method' => 'removeCodeResetPassword',
            'key' => $key
        );

        $result = self::CURL(static::$url_member, $param);
        if ($result->result_data->dataReturn->status == '1') {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for  check Email Exist
     *
     * @param  string $mobile_no
     * @param  string $ip
     * @return object
     * @access public
     */
    public static function checkEmailExist($email)
    {
        $param = array(
            'method' => 'checkEmailExist',
            'email' => $email,
            'app_id' => static::$app_id,
            'secret' => static::$secret
        );

        $result = self::CURL(static::$url_member, $param);

        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
            $result->result_data = @$result->result_data->dataReturn;

            return $result;
        }

        if (isset($result->result_data->dataReturn->uid)) {

            if ($result->result_data->dataReturn->uid == '' || $result->result_data->dataReturn->uid == '0') {
                $result->result_code = 1001;
                $result->result_desc = 'Email not found';
            }
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for  binding account
     *
     * @param  string $email
     * @return object
     * @access public
     */
    public static function bindingAccount($uid, $localuser_id, $access_token)
    {
        $param = array(
            'method' => 'bindingAccount',
            'localuser_id' => $localuser_id,
            'uid' => $uid,
            'app_id' => static::$app_id,
            'access_token' => $access_token
        );

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for  delete Binding Account
     *
     * @param  string $localuser_id
     * @param  string $uid
     * @param  sring  $access_token
     * @return object
     * @access public
     */

    public static function unBindingAccount($localuser_id, $uid, $access_token)
    {
        $param  = array(
            'method' => 'unBindingAccount',
            'localuser_id' => $localuser_id,
            'uid' => $uid,
            'access_token' => $access_token,
            'app_id' => static::$app_id
        );
        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for  delete Binding Account welove
     *
     * @param  string $localuser_id
     * @param  string $uid
     * @return object
     * @access public
     */
    public static function unBindForWelove($uid)
    {
        $param  = array(
            'method' => 'unBindForWelove',
            'uid' => $uid,
            'secret' => static::$secret,
            'app_id' => static::$app_id
        );
        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error) || $result->result_data->dataReturn == null) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for  Check Binding Account
     *
     * @param  string $localuser_id
     * @param  string $uid
     * @param  sring  $access_token
     * @return object
     * @access public
     */
    public static function checkBinding($uid, $access_token)
    {
        $param = array(
            'method' => 'checkBinding',
            'uid' => $uid,
            'access_token' => $access_token,
            'app_id' => static::$app_id
        );

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for  update Password
     *
     * @param  string $email
     * @param  string $new_password
     * @return object
     * @access public
     */
    public static function updatePassword($email, $new_password)
    {
        $param = array(
            'method' => 'updatePassword',
            'email' => $email,
            'new_password' => base64_encode($new_password),
            'app_id' => static::$app_id,
            'secret' => static::$secret
        );
        // echo static::$url_member;

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for  add mobile number
     *
     * @return object
     * @access public
     */
    public static function addMobileNumber($mobile, $access_token)
    {
        $param = array(
            'method' => 'addMobileNumber',
            'mobile' => $mobile,
            'access_token' => $access_token
        );

        $result = self::CURL(static::$url_member, $param);

        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for removeMobileNumber
     *
     * @param string mobile
     * @param string access_token
     * @return object
     * @access public
     */
    public static function removeMobileNumber($mobile, $access_token)
    {
        $param = array(
            'method' => 'removeMobileNumber',
            'mobile' => $mobile,
            'access_token' => $access_token
        );

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for  getMobileInfo
     *
     * @param string
     * @return object
     * @access public
     */
    public static function getMobileInfo($mobile, $access_token)
    {
        $param = array(
            'method' => 'removeMobileNumber',
            'mobile' => $mobile,
            'access_token' => $access_token
        );

        $result = self::CURL(static::$url_member, $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for  search
     *
     * @param string
     * @return object
     * @access public
     */
    public static function search()
    {
        $param = array(
            'method' => 'removeMobileNumber',
            'mobile' => $mobile,
            'access_token' => $access_token
        );

        $result = self::CURL(static::$url_profile . "/filter", $param);
        if (isset($result->result_data->dataReturn->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->dataReturn->error->message;
        }
        $result->result_data = @$result->result_data->dataReturn;

        return $result;
    }

    /**
     * The function for get all online
     *
     * @param string
     * @return object
     * @access public
     */
    public static function getAllOnline($type = 'all')
    {
        $param = array(
            'type' => $type,
            'app_id' => static::$app_id
        );

        //$url = "http://auth.platform.truelife.com/online/getAll?type=web";
        //echo static::$url_auth."/getAll?type=web";
        //echo "<hr>";
        $url    = static::$url_auth . "/online/getAll?type=" . $type;
        //echo "<hr>";
        $result = self::CURL($url, $param);

        if (isset($result->result_data->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->error->message;
        }
        $result->result_data = @$result->result_data;

        return $result;
    }

    /**
     * The function for  get list preference
     *
     * @access public
     */
    public static function getListPreference()
    {
        $url = static::$url_auth . "/sso/preferenceGetAll";

        return self::CURL($url);
    }

    /**
     * The function for get all online
     *
     * @param  number $uid
     * @param  string $file_name
     * @param  string $source    base64_encode(read file)
     * @return object
     * @access public
     */
    public static function uploadAvatar($uid, $file_name, $source)
    {
        $param = array(
            'uid' => $uid,
            'file_name' => $file_name,
            'source' => $source
        );

        $url = static::$url_profile . "/api/avatar/upload?app_id=" . static::$app_id . "&secret=" . static::$secret;

        $result = self::CURL($url, $param);

        if (isset($result->result_data->error)) {
            $result->result_code = 1000;
            $result->result_desc = $result->result_data->error->message;
        }
        $result->result_data = @$result->result_data;

        return $result;
    }

    /**
     * [CURL description]
     * @param [type]  $url     [description]
     * @param [type]  $post    [description]
     * @param integer $timeout [description]
     */
    private static function CURL($url, $post = null, $timeout = 29)
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
                curl_setopt($curl, CURLOPT_POSTFIELDS, (is_array($post) === true) ? http_build_query($post, '', '&') : $post);
            }

            $result = curl_exec($curl);

            if ($result === false) {
                $response = array(
                    'result_code' => curl_errno($curl),
                    'result_desc' => curl_error($curl),
                    'result_data' => null
                );

            } else {
                $result   = json_decode($result);
                $response = array(
                    'result_code' => 0,
                    'result_desc' => 'success',
                    'result_data' => $result
                );
            }
            curl_close($curl);
        }

        if (\Input::get('o_debug')) {
            echo "<pre>";
            echo $url;
            echo "</pre>";
            echo "<pre>";
            print_r($post);
            echo "</pre>";

            echo "<pre>";
            print_r($response);
            echo "</pre>";
        }

        $response = (object) $response;

        return $response;
    }

    public static function loginOld($user, $password)
    {
        $parameters = array(
            'method' => 'login',
            'username' => $user,
            'password' => $password,
            'service' => 'WLS',
            'apikey' => '1234',
            'o_debug' => '1234',
            'format' => 'json'
        );

        $url = "http://api-02.weloveshopping.com/rest/users/";

        $result = self::CURL($url, $parameters);

        if (isset($result) && isset($result->result_data->response)) {
            return $result->result_data->response;
        }


        return false;
    }


}
