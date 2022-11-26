<?php
class MyApp{

    public $controloller = 'index';
    public $method = 'index';
    public $params = [];

    public function __construct()
    {
        if (isset($_GET["url"])){
            $url = $_GET["url"];
            $url = $this->parsurl($url);
            $this->controloller = $url[0];
            if(isset($url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
            unset($url[0]);
            $this->params = array_values($url);
        }
        $controllerurl = 'controller/'.$this->controloller.'.php';
        if(file_exists($controllerurl)) {
            require ($controllerurl);
            $obj = new $this->controloller;
            if(method_exists($obj,$this->method)) {
                call_user_func_array([$obj, $this->method], $this->params);
            }
        }

    }
    public function parsurl($url)
    {
        $url = rtrim($url,"/");
        $url = explode("/",$url);
        return $url;
    }
}