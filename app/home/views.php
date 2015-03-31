<?php namespace home;

use el\TemplateTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class views
{
    use TemplateTrait;

    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function index()
    {
        $content = $this->getTemplate()->render('index.html');
        return $content;
    }

    public function home()
    {
        $content = $this->getTemplate()->render('home.html');
        return [ $content, 200 ];
    }
}
