<?php namespace el;

class RouteException extends \Exception {}

class Route 
{
    /**
     * uri 
     * 
     * @var string
     */
    protected $uri;
    
    /**
     * name 
     * 
     * @var string
     */
    protected $name;
    
    /**
     * target 
     * 
     * @var array
     */
    protected $target;

    /**
     * options

     * @var array
     */
    protected $options = array(
        'delimiter' => ':',
        'views' => 'views'
    );

    public function __construct($uri, $name, $options = array())
    {
        $this->name = $name;
        $this->uri = rtrim($uri, '/');
        $this->options = array_merge($this->options, $options);
    }

    /**
     * Set Target 
     * 
     * @param array $target target 
     * @return void
     */
    public function setTarget($target) 
    {
        // target must be in appliation:action format
        if (count(explode($this->options['delimiter'], $target)) != 2) {
            throw new RouteException(
                'Route: ' .  $target . 'is not in application:action format.');
        }
         
        $this->target = $target; 
    }

    /**
     * Get Controller 
     * 
     * @return string
     */
    public function getController()
    {
        return explode(
            $this->options['delimiter'], $this->target
        )[0] . '\\' . $this->options['views'];
    }

    /**
     * Get Action
     * 
     * @return string
     */
    public function getAction()
    {
        return explode($this->options['delimiter'], $this->target)[1];
    }

    /**
     * Get Uri 
     * 
     * @return string uri
     */
    public function getUri()
    {
        return $this->uri;         
    }

    /**
     * Get Name
     * 
     * @return string name 
     */
    public function getName()
    {
        return $this->name; 
    }

    /**
     * Get Target 
     * 
     * @return string target 
     */
    public function getTarget()
    {
        return $this->target;
    }
}
