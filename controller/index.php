<?php
class index extends controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $slider1 = $this->model->get_slider1();
        $slider2 = $this->model->get_slider2();
        $slider2_item = $slider2[0];
        $time_end = $slider2[1];

        $data = [$slider1,$slider2_item,$time_end];
        $this->view("index/index",$data);
    }
}