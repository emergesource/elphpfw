<?php namespace home;

use el\TemplateAwareTrait;

class views
{
    use TemplateAwareTrait;

    public function index()
    {
        $content = $this->getTemplate()->render('home.html');
        // var_dump($this->getTemplate());
        // Actions just return content & status
        return [ $content, 200 ];
    }
}
