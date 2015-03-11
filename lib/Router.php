<?php namespace el;

class RouterException extends \Exception {};

class Router
{
    /**
     * routes 
     * 
     * @var array
     */
    public $routes = array();
    
    /**
     * Add a route
     *
     * @param string $name route name
     * @param string $uri uri 
     * 
     * @return void
     */
    public function addRoute($name, $uri)
    {
        if (!array_key_exists($uri, $this->routes)) {
            $route = new Route($uri, $name);
            $this->routes[$uri] = $route;
        }         
    }

    /**
     * Set a target location for a uri
     *
     * @param mixed $uri uri 
     * @param mixed $target target 
     * 
     * @return void
     */
    public function setTarget($uri, $target)
    {
        $route = $this->match($uri);
        $route->setTarget($target);
    }

    /**
     * Check for a match in the routes list
     * If a match doesn't exist, create a default route
     * 
     * @param string $uri uri 
     * @throws RouterException 
     * @return Route 
     */
    public function match($uri)
    {
        // if there is not a named route, create default one
        if (!array_key_exists($uri, $this->routes)) {
            throw new RouterException('No match for route: ' . $uri);
        }
        return $this->routes[$uri];
    }

    /**
     * Load routes 
     * 
     * @param array $routes routes
     */
    public function load($routes = array())
    {
        foreach($routes as $key => $route) {
            $this->addRoute($key, $route['uri']); 
            $this->setTarget($route['uri'], $route['target']);
        } 
    }

    /**
     * Get routes
     * 
     * @return array routes
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}
