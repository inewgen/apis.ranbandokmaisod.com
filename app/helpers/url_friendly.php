<?php

if (!function_exists('friendlyUrl')) {
    function friendlyUrl($string, $skip_brackets = FALSE, $words = 0) {
        $string = str_replace("'", "", $string);
        $string = str_replace("/", "", $string);
        $string = str_replace("&", "", $string);
        //$string = preg_replace("`\[.*\]`U", "", $string);
        $string = preg_replace('`&(amp;)?#?[a-z0-9ก-๙เ-า]+;`i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace("`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i", "\\1", $string);
        if ($skip_brackets === TRUE)
            $string = preg_replace("`\(.*\)`U", "", $string);
        $string = preg_replace(array("`[^a-z0-9ก-๙เ-า]`i", "`[-]+`"), "-", $string);

        $url = strtolower(trim($string, '-'));

        if ($words > 0) {
            $_url = explode('-', $url);
            $_url = array_filter($_url, 'friendlyURL_filter');
            $_url = array_slice($_url, 0, $words);
            return implode('-', $_url);
        } else {
            return urlencode(mb_substr($url, 0, 255, 'UTF-8'));
        }
    }
}

if (!function_exists('friendlyURL_filter')) {
    function friendlyURL_filter($var) {
        if (is_numeric($var) OR strlen($var) <= 1 OR $var == '')
            return FALSE;
        else
            return TRUE;
    }
}