<?php

if (!function_exists('routeLoad')) {

    function routeLoad($uri = false, $req_path = false, $route_conf = false)
    {
        // preload, fixed when use API::xxx()
        $preload = $route_conf['preload'];
        if ($preload) {
            foreach ($preload as $_uri => $v) {
                if (strpos($req_path, $_uri) !== false) {
                    if (isset($v['include']) && $v['include']) {
                        // include from route optimize
                        foreach ($v['include'] as $_uri) {
                            if (strpos($uri, $_uri) !== false) {
                                return true;
                            }
                        }
                    }
                }
            }
        }

        if (App::environment() == 'testing') {
            return true;
        }


        if (strpos($req_path, $uri) !== false) {
            return true;
        }

        return false;
    }
}
