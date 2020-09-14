<?php

namespace heinthanth\bare\Routing;

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
    public function dispatch(string $request_uri, string $method): void
    {
        $cachedRoute = $this->cached();
        $route2match = (getenv('CACHE_ROUTE') && $cachedRoute !== null)
            ? $cachedRoute
            : (require_once __DIR__ . '/../../app/routes/web.php')->list();
        try {
            $info = RouteHandler::match($request_uri, $method, $route2match);
            print_r($info);
        } catch (RouteNotFoundException | MethodNotAllowedException $e) {
            echo $e->getMessage();
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
