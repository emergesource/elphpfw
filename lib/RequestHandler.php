<?php namespace el;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class RequestHandler
{
    protected $request;
    protected $response;
    protected $matcher;

    public function __construct(UrlMatcher $matcher)
    {
        $this->matcher = $matcher;
    }

    public function run(Request $request, Response $response)
    {
        try {
            $match = $this->matcher->match($request->getPathInfo());
    
            $class = new $match['controller'];
            $content = $class->$match['action']();

        } catch (ResourceNotFoundException $e) {
            $response->setStatusCode('404');
            $response->setContent('Not found');

        } catch (Exception $e) {
            $response->setStatusCode('500');
            $response->setContent('An error occured');
        }
    } 
}
