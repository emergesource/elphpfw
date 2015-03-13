<?php namespace el;

trait TemplateTrait
{
    protected $template;

    public function setTemplate($template)
    {
        $this->template = $template; 
    }

    public function getTemplate()
    {
        return $this->template;
    }
}
