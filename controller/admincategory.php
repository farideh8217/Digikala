<?php
class admincategory extends controller {
    public function __construct()
    {
    }
    function index(){
        $category = $this->model->get_category();
        $data = ['parentcategory'=>$category];
        $this->view("admin/category/index",$data);
    }

    function showchildren($id_category)
    {
        $showchildren = $this->model->category_chidren($id_category);
        $data = ["parentcategory"=>$showchildren];
        $parent =
        $this->view("admin/category/index",$data);
    }
}