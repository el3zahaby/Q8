<?php

if (! function_exists('setting')) {

    function setting($key, $default = null){
        if (is_null($key)) {
            return new \App\Setting();
        }

        if (is_array($key)) {
            return \App\Setting::set($key[0], $key[1]);
        }

        $value = \App\Setting::get($key); // ""

        return is_null($value) ? value($default) : $value;
    }
}
function filePath($path){
    return ltrim(parse_url($path, PHP_URL_PATH), '/');
}

function upayments($key= 'username'){
    if (config("upayments.debug")){
        return config("upayments.$key.0");
    }else{
        return config("upayments.$key.1");
    }

}


// For add'active' class for activated route nav-item
function active_class($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

// For checking activated route
function is_active_route($path) {
    return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

// For add 'show' class for activated route collapse
function show_class($path) {
    return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}
