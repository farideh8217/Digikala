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
        $getcategorychildren = $this->model->get_category_children($id_category);
        $data = ['children'=>$getcategorychildren];
        $this->view("admin/category/index");
    }
}