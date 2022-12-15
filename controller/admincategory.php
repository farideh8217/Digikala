<?php
class admincategory extends controller {
    public function __construct()
    {
    }
    function index(){
        $getcategory = $this->model->get_category();
        $data = ['category'=>$getcategory];
        $this->view("admin/category/index");
    }

    function children_category($id_category)
    {
        $categoryinfo = $this->model->category_info($id_category);
        $children = $this->model->get_category_children($id_category);
        $parents = $this->model->get_parent($id_category);
        $data = ['categoryInfo'=>$categoryinfo,'category'=>$children,'parents'=>$parents];
        $this->view("admin/category/index");
    }
}