<?php namespace el;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Maestro;
use Auryn\Provider;

class RequestHandler
{
    protected $matcher;
    protected $loader;
    protected $template;
    protected $di;

    public function __construct(UrlMatcher $matcher, Provider $di)
    {
        $this->matcher = $matcher;
        $this->loader = new \Twig_Loader_Filesystem(__DIR__ .  '/../templates');
        $this->template = new \Twig_Environment($this->loader, [
            'cache' => __DIR__ . '/../templates/.cache',
            'auto_reload' => true
        ]);
        $this->di = $di;
    }

    public function run(Request $request, Response $response)
    {
        try {
            $match = $this->matcher->match($request->getPathInfo());
              
            $controller = $this->di->make($match['controller']);
            $traits = class_uses($controller);

            foreach($traits as $trait) { 
                if ($trait == 'el\TemplateTrait') {
                    $maestro = new Maestro(PROJECT_ROOT);
                    $this->loader->prependPath(
                        $maestro->getBaseDir($match['controller'])
                        . DIRECTORY_SEPARATOR 
                        . TEMPLATES
                    );
                    $controller->setTemplate($this->template);
                }
            }

            list ($content, $status) = $controller->$match['action']();

            $response->setStatusCode($status);
            $response->setContent($content);

        } catch (ResourceNotFoundException $e) {
            $response->setStatusCode('404');
            $response->setContent($this->container['template']->render('404.html'));

        } catch (Exception $e) {
            $response->setStatusCode('500');
            $response->setContent($this->container['template']->render('500.html'));
        }
    } 
}
