<?php namespace home;

use el\TemplateTrait;

class views
{
    use TemplateTrait;

    public function index()
    {
        $content = $this->getTemplate()->render('index.html');
        return [ $content, 200 ];
    }

    public function home()
    {
        $content = $this->getTemplate()->render('home.html');
        return [ $content, 200 ];
    }
}
