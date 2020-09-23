<?php

declare(strict_types=1);

use Laminas\Diactoros\Response\HtmlResponse;
use heinthanth\bare\Support\{View, Env};

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param string $needle
     * @param mixed $default
     * @return mixed
     */
    function env(string $needle, $default = null)
    {
        return Env::get($needle, $default);
    }
}

if (!function_exists('arr_get')) {
    /**
     * Parse and get array with DotNotation
     * @return mixed
     */
    function arr_get(string $needle, array $data, $default = null)
    {
        if (!is_string($needle) || empty($needle) || !count($data)) return $default;
        if (strpos($needle, '.') !== false) {
            $keys = explode('.', $needle);
            foreach ($keys as $innerKey) {
                if (!array_key_exists($innerKey, $data))  return $default;
                $data = $data[$innerKey];
            }
            return $data;
        }
        return array_key_exists($needle, $data) ? $data[$needle] : $default;
    }
}

if (!function_exists('render_template')) {
    /**
     * Render view template into HTML strings
     * 
     * @param string $path template path
     * @param array $data data for template
     * 
     * @return string HTML strings
     */
    function render_template(string $path, array $data = [])
    {
        return View::render($path, $data);
    }
}

if (!function_exists('view')) {
    /**
     * Return Response object with rendered HTML string.
     * @param string $path template path
     * @param array $data data for template
     * 
     * @return \Psr\Http\Message\ResponseInterface Response object with HTML strings
     */
    function view(string $path, array $data = [], int $statusCode = 200)
    {
        return new HtmlResponse(render_template($path, $data), $statusCode);
    }
}