<?php namespace home\controller;

use el\TemplateTrait;

class test
{
    use TemplateTrait;

    public function index()
    {
        $content = $this->getTemplate()->render('test.html');
        return [ $content, 200];
    }
}
