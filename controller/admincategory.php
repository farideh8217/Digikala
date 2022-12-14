<?php
class admincategory extends controller {
    public function __construct()
    {
    }
    function index(){
        $category = $this->model->get_category();
        $data = ['category'=>$category];
        $this->view("admin/category/index",$data);
    }

    function showchildren($id_category=0)
    {
        $category_children = $this->model->get_children($id_category);
        $parent_category = $this->model->get_parent_category($id_category);
        $category_info = $this->model->category_info($id_category);
        $data = ['category'=>$category_children, "parentcategory"=>$parent_category,"categoryinfo"=>$category_info];
        $this->view("admin/category/index",$data);
    }

    function addcategory($parenId = 0,$edit=""){

        if(isset($_POST["title"],$_POST["parent"])) {
            $title = $_POST["title"];
            $parent = $_POST["parent"];
            if(trim($title) === "") {
                $error = "وارد کردن عنوان دسته اجباری است";
                $data = ["error"=>$error];
                $this->view("admin/category/addcategory",$data);
                exit();
            }else {
                $add_category = $this->model->add_category($title, $parent,$edit,$parenId);
                if(isset($insert) && $insert == true) {
                    $error = "اطلاعات با موفقیت درج شد";
                }else{
                    $error = "اطلاعات با موفقیت ویرایش شد";
                }
                    $data = ["error" => $error];
                    $this->view("admin/category/addcategory", $data);
            }
        }
        $all_category = $this->model->all_category();
        $category_info = $this->model->category_info($parenId);
        $data = ["allcategory"=>$all_category,"parenId"=>$parenId,"edit"=>$edit,"category_info"=>$category_info];
        $this->view("admin/category/addcategory",$data);
    }

    function deletecategory()
    {
        $ids = $_POST["id"];
        $deletecategory = $this->model->delete_category($ids);
        header("Location: ".URL."admincategory");
    }
}