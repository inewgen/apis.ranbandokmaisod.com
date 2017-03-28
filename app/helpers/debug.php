<?php

/**
 * Print the given value and kill the script.
 *
 * @param  mixed  $value
 * @return void
 */
if (!function_exists('alert')) {
    function alert($value, $die = false)
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
        if ($die) {
            die;
        }
    }
}

if (!function_exists('sdebug')) {
    function sdebug($value, $die = false)
    {
        if (isset($_GET['sdebug'])) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
            if ($die) {
                die;
            }

        }
    }
}

/**
 * Dump the given value and kill the script.
 *
 * @param  mixed  $value
 * @return void
 */
if (!function_exists('dump')) {
    function dump($value, $die = false)
    {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        if ($die) {
            die;
        }

    }
}

/**
 * Print the given value and kill the script.
 *
 * @param  mixed  $value
 * @return void
 */
if (!function_exists('jsn')) {
    function jsn($value, $die = true)
    {
        // echo "<pre>";
        echo json_encode($value);
        //echo "</pre>";
        if ($die) {
            die;
        }

    }
}
