<?php

namespace E5\Shared;


class Router
{
    public function __construct(private $uri)
    {
     
    }

    public function add($route, $callback)
    {
        $this->callback_route($callback, $route);
    }

    public function callback_route($callback, $route)
    {
        if ($this->match_uri($this->uri, $route)) {
            $params = $this->get_params($this->uri, $route);
            call_user_func($callback, ...$params);
            return;
        }
    }

    private function get_params($uri, $route)
    {
        $route = $route[0] == '/' ? substr($route, 1) : $route;

        if (!(strpos($route, ':')!==false || strpos($route, '{')!==false)) {
            return array();
        }
        $temp_route = explode('/', $route);
        $temp_params = array();
        $temp_uri_explode = explode('/', $uri);
        foreach ($temp_route as $index => $value) {
            if (strpos($value, ':')!==false || strpos($value, '{')!==false) {
                array_push($temp_params,  $temp_uri_explode[$index]);
            }
        };
        return $temp_params;
    }

    private function match_uri($uri, $route)
    {
        $route = $route[0] == '/' ? substr($route, 1) : $route;

        $temp_route = explode('/', $route);
        foreach ($temp_route as $key => $value) {
            if (strpos($value, ':')!==false || strpos($value, '{')!==false) {
                $temp_route[$key] = '[ñ \w]+';
            }
        };

        $regex = '/' . implode('\/', $temp_route) . '\/' . '|' . implode('\/', $temp_route) . '/';
        preg_match($regex, $uri, $output_array);
        return ($output_array && str_replace($output_array[0], '', $uri) == '');
    }
}
