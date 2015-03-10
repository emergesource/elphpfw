<?php namespace el;

class Request
{
    protected $params;
    protected $server;
    protected $cookies;

    public function __construct($get, $post, $server, $cookies)
    {
        $this->params = $this->strip(array_merge($get, $post));
        $this->server = $this->strip($server);
        $this->cookies = $this->strip($cookies);
    }

    /**
     * Get a get/post parameter value
     * 
     * @param string $name param name 
     * @param mixed $default default 
     * 
     * @return mixed value 
     */
    public function getParam($name, $default = null)
    {
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        }
        return $default;
    }

    /**
     * Get GET/POST params 
     * 
     * @return array params
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Get request method
     * 
     * @return string request method
     */
    public function getMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }

    /**
     * Get request URI
     * 
     * @return string request uri 
     */
    public function getUri()
    {
        return $this->server['REQUEST_URI'];
    }

    /**
     * Get query string
     * 
     * @return string query string
     */
    public function getQueryString()
    {
        return $this->server['QUERY_STRING'];
    }
    
    /**
     * Removes magic quotes on an array of values
     * 
     * @param array $data data 
     * @return array data 
     */
    private function strip($data = array())
    {
        if (get_magic_quotes_gpc()) {
            function stripslashes_array($data) {
                return is_array($data) ? array_map('stripslashes_array', $data)
                : stripslashes($data); 
            }             
        } 
        return $data;
    }
}
