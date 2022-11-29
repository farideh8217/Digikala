<?php

class product extends controller
{
    public function __construct()
    {
    }

    public function index($id)
    {
        $productinfo = $this->model->product_info($id);
        $data = ['productinfo'=>$productinfo];
        $this->view("product/index",$data);
    }
}