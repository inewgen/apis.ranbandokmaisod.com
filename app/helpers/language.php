<?php
/**
 * Alias of Lang Template
 *
 * Fetches a language template
 *
 * @access	public
 * @param	 string	key (file name without extension)
 * @param	 array
 * @param string (option)
 * @return	string
 */
if (!function_exists('_t')) {
    function _t($key, $prepare=array(), $idiom=null)
    {
        //return lang_template($key, $prepare, $idiom);
        return $key;
    }
}

/**
 * Alias of Lang
 *
 * Fetches a language variable
 *
 * @access	 public
 * @param	 string	the language key
 * @param	 array
 * @return	string
 */
if (!function_exists('_s')) {
    function _s($line, $prepare=array())
    {
        return lang($line, $prepare);
    }
}

/**
 * Alias of Lang with print
 *
 * Print a language variable
 *
 * @access	 public
 * @param	 string	the language key
 * @param	 array
 * @return	string (output)
 */
if (!function_exists('_e')) {
    function _e($line, $prepare=array())
    {
        echo lang($line, $prepare);
    }
}

if (!function_exists('lang')) {
    function lang($line,$prepare)
    {
        $line = trim($line);
        if (empty($line)) {
            return $line;
        }

        $translate = Cache::rememberForever($line, function () use ($line) {
            return Translate::where('key', '=',$line)->with('languages')->first();
        });

        if (count($translate)==0) {
            $translate = new Translate();
            $translate->key = $line;
            $translate->location = $_SERVER['REQUEST_URI'];
            $translate->save();
        }

        $lang = Session::get('language');
        //alert($translate->languages);
        foreach ($translate->languages as $language) {
            $entry['title'][getLangCode($language->language_id)]= $language->title;
        }

        if (empty($entry['title'][$lang])) {
            return $line;
        }
        //alert(DB::getQueryLog()); die();
           return $entry['title'][$lang];
    }
}

/**
 * [_m description]
 * @param  [type] $name [description]
 * @return [type]       [description]
 */
if (!function_exists('_m')) {
    function _m($name)
    {
        echo $name;
        //echo $name
        // logo-th.jpg
    }
}

/**
 * [_m description]
 * @param  [type] $name [description]
 * @return [type]       [description]
 */
if (!function_exists('getLangCode')) {
    function getLangCode($key)
    {
        $lang = array(1=>'th',2=>'en'/*,3=>'zh',4=>'lo',5=>'ja'*/);

        return isset($lang[$key]) ? $lang[$key] : '';
    }
}

/**
 * [_m description]
 * @param  [type] $name [description]
 * @return [type]       [description]
 */
if (!function_exists('getLangId')) {
    function getLangId($key)
    {
        $lang = array('th'=>1,'en'=>2/*,'zh'=>3,'lo'=>4,'ja'=>5*/);

        return isset($lang[$key]) ? $lang[$key] : '';
    }
}

/**
 * [_m description]
 * @param  [type] $name [description]
 * @return [type]       [description]
 * for plaza category
 */
if (!function_exists('getLanguage')) {
    function getLanguage()
    {
        $lang = array(1=>'th',2=>'en');

        return $lang;
    }
}
