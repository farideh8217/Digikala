<?php
class adminproduct extends controller{
    function index(){
        $products = $this->model->get_product();
        $data = ["product"=>$products];
        $this->view("admin/product/index",$data);
    }

    function addproduct($productId='')
    {
        if(isset($_POST["title"],$_POST["categoryId"],$_POST["price"],$_POST["introduction"],$_POST["discount"],$_POST["tedad_mojood"],$_POST["color"])){
            $this->model->add_product($_POST,$productId);
        }
        $category = $this->model->get_category();
        $color = $this->model->get_color();
        $garantee = $this->model->get_garantee();
        $productInfo = $this->model->get_product_info($productId);
        $color_info = $this->model->get_color_info($productId);
        $data = ["category"=>$category,'color'=>$color,'garantee'=>$garantee,'productInfo'=>$productInfo,'productId'=>$productId];
        $this->view("admin/product/addproduct",$data);
    }
}