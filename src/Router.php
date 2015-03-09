<?php namespace el;

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
            $route = new Route($name, $uri);
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
     * 
     * @return Route 
     */
    public function match($uri)
    {
        // if there is not a named route, create default one
        if (!array_key_exists($uri, $this->routes)) {
            $route = new Route('default', $uri);
            $route->setDefaultTarget($uri);
            return $route;
        }
        return $this->routes[$uri];
    }
}
