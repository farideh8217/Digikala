<?php
class admin extends controller{
    public function __construct()
    {
    }
    function index()
    {
        $this->view("index/index");
    }
}