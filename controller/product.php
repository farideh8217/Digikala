<?php
class product extends controller {
    public function __construct()
    {
    }
    public function index()
    {
        $this->view("product/index");
    }
}