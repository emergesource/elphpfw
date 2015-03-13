<?php namespace home;

class views
{
    public function index()
    {
        // controller just returns content & status
        return [ 'home/views/index', 200 ];
    }
}
