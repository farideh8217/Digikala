<?php
class controller{
    /**
     * @var mixed
     */


    public function __construct()
    {
    }
    public function model($modelurl)
    {
        require ("models/model_".$modelurl.".php");
        $classname = "model_".$modelurl;
        $this->model = new $classname;
    }
    public function view($viewurl,$data=[])
    {
        require ("header.php");
        require ("views/".$viewurl.".php");
        require ("footer.php");
    }

}