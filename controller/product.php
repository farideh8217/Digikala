<?php

class product extends controller
{
    public function __construct()
    {
    }

    public function index($id)
    {
        $productinfo = $this->model->product_info($id);
        $onlyclicksite = $this->model->onlyclicksite();
        $color_product = $this->model->color_info($id);
        $garantee_product = $this->model->garantee_info($id);
        $data = ['productinfo'=>$productinfo,'onlyclicksite'=>$onlyclicksite,'color_product'=>$color_product,'garantee_product'=>$garantee_product];
        $this->view("product/index",$data);
    }
    function tab($id,$id_category)//با ایجکس ایدی محصول را فرستاد
    {
        $number = $_POST['number'];
        if($number==0){
            $naghd = $this->model->naghd($id);
            $data = [$naghd];
            $this->view('product/tab1',$data,1,1);
        }
        if($number==1){
            $fani = $this->model->fani($id,$id_category);
            $data = [$fani];
            $this->view('product/tab2',$data,1,1);
        }
        if($number==2){
        $comment_param=$this->model->comment_param($id_category,$id);
        $comment_param_name = $comment_param[0];
        $comment_param_score = $comment_param[1];
        $get_comment = $this->model->get_comment($id);
        $data = [$comment_param_name,$get_comment,$comment_param_score];
        $this->view('product/tab3',$data,1,1);
        }
        if($number==3){
        $question = $this->model->get_question($id);
        $data = [$question];
        $this->view('product/tab4',$data,1,1);
        }
    }
}