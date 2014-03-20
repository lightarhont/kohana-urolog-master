<?php defined('SYSPATH') OR die('No direct script access.');

class Route extends Kohana_Route {
    
    public static $default_name_prefix = '';
    
    public static function set($name, $uri = NULL, $regex = NULL)
    {
	$name = Route::$default_name_prefix.$name;
        return Route::$_routes[$name] = new Route($uri, $regex);
    }
}
