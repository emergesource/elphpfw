# Eluisvelabs PHP Framework
A Django inspired modular MVC for PHP.

### Route to any psr4 class and use it as a controller.
```php
$routes->add('controller', new Route( '/', [
    'controller' => 'any\psr4\namespace\controller', 
    'action' => 'index'
]));
```

#### Your controller does not depend on a base class
```php
class MyController
{
    public function index()
    {
        return ['some content', 200];
    }
}
```
