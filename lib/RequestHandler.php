<?php namespace el;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class RequestHandler
{
    protected $matcher;

    public function __construct(UrlMatcher $matcher)
    {
        $this->matcher = $matcher;
        $loader = new \Twig_Loader_Filesystem(__DIR__ .  '/../templates');
        $this->template = new \Twig_Environment($loader, [
            'cache' => __DIR__ . '/../templates/.cache',
            'auto_reload' => true
        ]);
    }

    public function run(Request $request, Response $response)
    {
        try {
            $match = $this->matcher->match($request->getPathInfo());
    
            $controller = new $match['controller'];
            $traits = class_uses($controller);

            foreach($traits as $trait) { 
                if ($trait == 'el\TemplateTrait') {
                    $controller->setTemplate($this->template);
                }
            }

            list ($content, $status) = $controller->$match['action']();

            $response->setStatusCode($status);
            $response->setContent($content);

        } catch (ResourceNotFoundException $e) {
            $response->setStatusCode('404');
            $response->setContent('Not found');

        } catch (Exception $e) {
            $response->setStatusCode('500');
            $response->setContent('An error occured');
        }
    } 
}
