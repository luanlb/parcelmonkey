<?php
namespace Parcelmonkey\model;

class HelloWorld
{
    private $hello;
    private $echo;

    public function __construct($hello,$echo)
    {
        $this->hello = $hello;
        $this->echo  = $echo;
    }

    public function getHello()
    {
        return $this->hello;
    }

    public function getEcho()
    {
        return $this->echo;
    }

    public function setEcho($echo)
    {
        $this->echo = $echo;
    }
}
