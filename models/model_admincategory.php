<?php
class model_admincategory extends Model{
    public function __construct()
    {
        parent::__construct();
    }
    function get_category()
    {
        $sql = "SELECT * FROM tbl_category";
        $result = $this->doSelect($sql);
        return $result;
    }

    function get_category_children($id_category)
    {
        $sql = "SELECT * FROM tbl_category where parent=?";
        $result = $this->doSelect($sql,[$id_category]);
        return $result;
    }

    function get_parent($id_category)
    {
        $category_info = $this->category_info($id_category);
        $parent = $category_info["parent"];
        $all_parent = [];
        while ($parent != 0) {
            $sql = "SELECT * FROM tbl_category where id=?";
            $result = $this->doSelect($sql,[$parent],1);
            array_push($all_parent,$result);
            $parent = $result["parent"];
        }
        return $all_parent;
    }

    function category_info($id_category)
    {
        $sql = "select * from tbl_category WHERE id=?";
        $result = $this->doSelect($sql,[$id_category]);
        return $result;
    }
}