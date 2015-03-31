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

            list($content, $status) = $this->parseActionResponse(
                $controller->$match['action']()
            );
            
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

    /**
     * Parse an action response.
     * Prepare and add defaults to action response data
     * 
     * @param mixed $actionResponse actionResponse 
     * @return list ($content, $status)
     */
    public function parseActionResponse($actionResponse)
    {
        $content = '';
        $status = 200;

        // use both the content and status from the action response
        if (is_array($actionResponse)) {
            list($content, $status) = $actionResponse;
        }

        // use the content, and default status from the action response
        $content = $actionResponse;
        
        return [ $content, $status ];
    }
}
