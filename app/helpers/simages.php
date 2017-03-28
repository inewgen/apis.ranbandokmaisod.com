<?php
class Simages
{
    // img|image, default|user_id, array(), 100, 100
    public function getImageLink($type, $section, $code, $extension, $w, $h, $name = 'ranbandokmaisod.jpg')
    {
        if (empty($type) || empty($section) || empty($code) || empty($extension)) {
            return false;
        }

        $ranbandokmaisod_res = Config::get('url.ranbandokmaisod-res');

        if ($type == 'img') {
            return $ranbandokmaisod_res . '/img/' . $section . '/' . $code . '/' . $extension . '/' . $w . '/' . $h . '/' . $name;
        }
        $user_id = $section;

        return $ranbandokmaisod_res . '/image/' . $user_id . '/' . $code . '/' . $extension . '/' . $w . '/' . $h . '/' . $name;
    }

    public function getImageProfile($user, $w, $h)
    {
        if (empty($user) || empty($w) || empty($h)) {
            return false;
        }

        $ranbandokmaisod_res = Config::get('url.ranbandokmaisod-res');
        $user_id = $user->id;
        $code = $user->images[0]->code;
        $extension = $user->images[0]->extension;
        $name = 'profile.jpg';

        return $ranbandokmaisod_res . '/image/' . $user_id . '/' . $code . '/' . $extension . '/' . $w . '/' . $h . '/' . $name;
    }

    public function getLogo($w, $h)
    {
        if (empty($w) || empty($h)) {
            return false;
        }
        $ranbandokmaisod_res = Config::get('url.ranbandokmaisod-res');
        $name = 'logo.jpg';

        return $ranbandokmaisod_res . '/img/default/ranbandokmaisod_logo/png/' . $w . '/' . $h . '/' . $name;
    }
}
