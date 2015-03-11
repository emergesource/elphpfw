<?php namespace home;

use el\Request;

class views
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request; 
    }

    public function index()
    {
        var_dump($this->request);
    }
}
