# Elusivelabs PHP Framework
A Django inspired modular MVC for PHP.

#### Route to any psr4 class and use it as a controller
```php
...
$routes->add('controller', new Route( '/', [
    'controller' => 'MyModule\MyController', 
    'action' => 'index'
]));
...
```

#### Actions return content & staus 
```php
    ... 
    public function index()
    {
        return['content', 200] 
    }
    ...
```

#### Your controller does not depend on a base class
```php
<?php namespace MyModule;

class MyController
{
    public function index()
    {
        return ['some content', 200];
    }
}
```

#### Use the template trait to have access to the rendering engine
```php
<?php namespace MyModule;

class MyControlller
{
    use TemplateTrait;

    public function index()
    {
        $content = $this->getTemplate()->render('index.html');
        return [$content, 200];
    }
}
```

#### Inject objects into the constructor of your controller
```php
<?php namespace MyModule

use Symfony\Component\HttpFoundation\Request;

class MyController()
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request; 
    }
}
```
