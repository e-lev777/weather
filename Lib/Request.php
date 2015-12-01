<?php
namespace Lib;

class Request
{
    private $get = array();
    private $post = array();
    private $server = array();

    public function __construct(){
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
    }

    public function get($key){
        return isset($this->get[$key]) ? $this->get[$key] : null;
    }

    public function post($key){
        return isset($this->post[$key]) ? $this->post[$key] : null;
    }

    public function server($key){
        return isset($this->server[$key]) ? $this->server[$key] : null;
    }

    public function isPost(){
        return (bool)$this->post;
    }
}