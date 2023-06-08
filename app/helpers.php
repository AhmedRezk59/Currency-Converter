<?php

use Core\Session\Session;
use Core\View\View;

if (!function_exists('root_path')) {
    function root_path()
    {
        return realpath(__DIR__ . '/../');
    }
}

if (!function_exists('ds')) {
    function ds()
    {
        return DIRECTORY_SEPARATOR;
    }
}

if (!function_exists('dump')) {
    function dump($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}

if (!function_exists('view')) {
    function view(string $path, array $data = [])
    {
        return View::render($path, $data);
    }
}

if(! function_exists('url')){
    function url(string $path){
        return \Core\Url\Url::path($path);
    }
}

if(! function_exists('session')){
    function session(string $key){
        return Core\Session\Session::get($key);
    }
}

if(! function_exists('session_flash')){
    function session_flash(string $key){
        return \Core\Session\Session::flash($key);
    }
}

if(! function_exists('require_file')){
    function require_file(string $path){
        return Core\File\File::require_once($path);
    }
}

if(! function_exists('csrf_field')){
    function csrf_field(){
        echo '<input type="hidden" name="_token" value="' . Session::get('_token') . '">';
    }
}