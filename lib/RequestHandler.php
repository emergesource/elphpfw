<?php namespace el;

use Auryn\Provider;

class RequestHandler
{
    protected $di;
    protected $request;
    protected $response;
    protected $router;

    public function __construct(Request $request, Router $router)
    {
        $this->request = $request;
        $this->router = $router;

        $this->di = new \Auryn\Provider();
        $this->di->share($this->request);
    }

    public function run()
    {
        $route = $this->router->match($this->request->getUri());

        try {

            $this->dispatch($route);

        } catch (Exception $e) {
            var_dump($e->getMessage());
            return;
        }
    } 

    public function dispatch($route)
    {
        $class = $route->getController();
        $controller = $this->di->make($class);
        $action = $route->getAction();
        $controller->$action();
    }
}
