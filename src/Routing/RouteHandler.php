<?php

namespace heinthanth\bare\Routing;

use heinthanth\bare\Routing\Exception\RouteNotFoundException;
use heinthanth\bare\Routing\Exception\MethodNotAllowedException;

final class RouteHandler
{
    /**
     * Match request URI with routes list and return infos
     * 
     * @param string $request_uri Current Server Request URI
     * @param string $method Current Server Request method
     * @param array $routes Registered Routes.
     * 
     * @return array List of parameters from matched routes
     * 
     * @throws MethodNotAllowedException throws if route matched, but no matches in method.
     * @throws RouteNotFoundException throws if no route matched.
     */
    public static function match(string $request_uri, string $method, array $routes): array
    {
        $url = explode("?", $request_uri, 2);
        $queries = [];

        if (count($url) == 2) {
            $request_uri = $url[0];
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                list($k, $v) = explode('=', $param, 2);
                $queries[$k] = $v;
            }
        }

        // check in respective routes
        foreach ($routes as $regex => $info) {
            if (preg_match($regex, $request_uri, $matched)) {
                $variables = [];
                foreach ($matched as $k => $v) {
                    if (is_string($k)) {
                        $variables[$k] = $v;
                    }
                }

                if (isset($info[$method])) {
                    return [
                        'uri' => $request_uri,
                        'method' => $method,
                        'param' => [
                            'variables' => $variables,
                            'queries' => $queries
                        ],
                        'callback' => $info[$method]
                    ];
                } else if (isset($info['ALL'])) {
                    return [
                        'uri' => $request_uri,
                        'method' => $method,
                        'param' => [
                            'variables' => $variables,
                            'queries' => $queries
                        ],
                        'callback' => $info['ALL']
                    ];
                }
                throw new MethodNotAllowedException();
            }
        }
        throw new RouteNotFoundException();
    }

    /**
     * Parse registered route and return an associative array with Regex
     * 
     * @param string $uri URI to be converted.
     * 
     * @return string Regular Expression from converted URI.
     */
    public static function uri2regex(string $uri): string
    {
        // convert string to regex: escape slashes.
        $regex = str_replace('/', '\\/', $uri);
        // convert variable to regex with named capture.
        $regex = preg_replace('/\{([A-Za-z_][A-Za-z0-9_]*)\}/', '(?P<\1>[A-Za-z0-9-_]*)', $regex);
        // if there's user-defined regex, use it instead of default one.
        $regex = preg_replace('/\{([A-Za-z_][A-Za-z0-9_]*):([^\}]+)\}/', '(?P<\1>\2)', $regex);
        // return routes as regex (case sensitive or not).
        return getenv('CASE_SENSITIVE_ROUTE') ? '/^' . $regex . '$/' : '/^' . $regex . '$/i';
    }
}
