<?php
class controller{
    public function __construct()
    {
    }
    public function view($viewurl)
    {
        require ("header.php");
        require ("views/".$viewurl.".php");
        require ("footer.php");
    }
    public function model($modelurl)
    {
        require ("models/model_".$modelurl.".php");
        $classname = "model_".$modelurl;
        $this->model = new $classname;
    }
}