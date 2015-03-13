<?php namespace home;

use el\TemplateTrait;

class views
{
    use TemplateTrait;

    public function index()
    {
        // $content = 'yo yo ma';
        $content = $this->getTemplate()->render('index.html');
        // var_dump($this->getTemplate());
        // Actions just return content & status
        return [ $content, 200 ];
    }
}
