<?php
class model_admincategory extends Model{
    public function __construct()
    {
        parent::__construct();
    }
    function get_category()
    {
        $sql = "SELECT * FROM tbl_category where parent=0";
        $result = $this->doSelect($sql);
        return $result;
    }

    function category_chidren($id_category)
    {
        $sql = "SELECT * FROM tbl_category where parent=?";
        $result = $this->doSelect($sql,[$id_category]);
        return $result;
    }

    function get_parent($id_category)
    {
        $sql = "SELECT * FROM tbl_category WHERE id=?";
        $result = $this->doSelect($sql,[$id_category],1);
        $parent = $result["parent"];
        $all_parent = [];
        while ($parent != 0) {
            $sql = "SELECT * FROM tbl_category WHERE parent=?";
            $result = $this->doSelect($sql,[$parent]);
            array_push($all_parent,$result);
            $parent = $result["parent"];
        }
        return $all_parent;
    }

}