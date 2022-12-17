<?php
class admincategory extends controller {
    public function __construct()
    {
    }
    function index(){
        $getcategory = $this->model->get_category_children(0);
        $data = ['category'=>$getcategory];
        $this->view("admin/category/index",$data);
    }

    function showchildren($id_category)
    {
        $categoryinfo = $this->model->category_info($id_category);
        $children = $this->model->get_category_children($id_category);
        $parents = $this->model->get_parent($id_category);
        $data = ['categoryInfo'=>$categoryinfo,'category'=>$children,'parents'=>$parents];
        $this->view("admin/category/index",$data);
    }

    function addcategory()
    {
        if (isset($_POST["title"])){
            $title = $_POST["title"];
            $parent = $_POST["parent"];
            $this->model->add_category($title,$parent);
        }
        $category = $this->model->get_category();
        $data = ["category"=>$category];
        $this->view("admin/category/addcategory",$data);
    }
}