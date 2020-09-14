<?php

namespace heinthanth\bare\Routing;

use heinthanth\bare\Routing\Exception\CallbackNotExistsException;
use heinthanth\bare\Routing\Exception\InvalidCallbackException;
use heinthanth\bare\Routing\Exception\RouteNotFoundException;
use heinthanth\bare\Routing\Exception\MethodNotAllowedException;

final class Router
{
    /**
     * Match URI with routes and Execute callback handler.
     * 
     * @param string $request_uri Current Server Request URI
     * @param string $method Current Server Request Method
     * 
     * @return void
     */
    public function dispatch(string $request_uri, string $method)
    {
        $cachedRoute = $this->cached();
        $route2match = (getenv('CACHE_ROUTE') && $cachedRoute !== null)
            ? $cachedRoute
            : (require_once __DIR__ . '/../../app/routes/web.php')->list();
        try {
            $info = RouteHandler::match($request_uri, $method, $route2match);
            try {
                return CallbackHandler::handleCallback($info['callback'], $info['param']);
            } catch (InvalidCallbackException | CallbackNotExistsException $e) {
                return $e->getMessage();
            }
        } catch (RouteNotFoundException | MethodNotAllowedException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Check for cached routes. If file exists, return it instead of parsing and adding again.
     * 
     * @return array
     */
    public function cached(): ?array
    {
        $cachedRoute = __DIR__ . '/../../storage/cache/route.cache.php';
        if (file_exists($cachedRoute) && filesize($cachedRoute) !== 0) {
            return (require_once $cachedRoute);
        }
        return null;
    }
}
