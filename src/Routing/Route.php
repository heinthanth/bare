<?php

namespace heinthanth\bare\Routing;

final class Route
{
    /**
     * list of routes added at runtime.
     * @var array $routes
     */
    private array $routes = [];

    /**
     * Register a route with GET request method
     * 
     * @param string $uri URI to catch
     * @param mixed $handler Callback handler to execute if URI matched
     * 
     * @return void
     */
    public function get(string $uri, $handler): void
    {
        $this->routes[RouteHandler::uri2regex($uri)]['GET'] = $handler;
    }

    /**
     * Register a route with POST request method
     * 
     * @param string $uri URI to catch
     * @param mixed $handler Callback handler to execute if URI matched
     * 
     * @return void
     */
    public function post(string $uri, $handler): void
    {
        $this->routes[RouteHandler::uri2regex($uri)]['POST'] = $handler;
    }

    /**
     * Register a route with PUT request method
     * 
     * @param string $uri URI to catch
     * @param mixed $handler Callback handler to execute if URI matched
     * 
     * @return void
     */
    public function put(string $uri, $handler): void
    {
        $this->routes[RouteHandler::uri2regex($uri)]['PUT'] = $handler;
    }

    /**
     * Register a route with DELETE request method
     * 
     * @param string $uri URI to catch
     * @param mixed $handler Callback handler to execute if URI matched
     * 
     * @return void
     */
    public function delete(string $uri, $handler): void
    {
        $this->routes[RouteHandler::uri2regex($uri)]['DELETE'] = $handler;
    }

    /**
     * Register a route with all request method
     * 
     * @param string $uri URI to catch
     * @param mixed $handler Callback handler to execute if URI matched
     * 
     * @return void
     */
    public function all(string $uri, $handler): void
    {
        $this->routes[RouteHandler::uri2regex($uri)]['ALL'] = $handler;
    }

    /**
     * Get list of routes.
     * 
     * @return array $routes list of registered routes.
     */
    public function list(): array
    {
        return $this->routes;
    }
}
