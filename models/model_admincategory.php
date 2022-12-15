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
        $sql="SELECT * FROM tbl_category where parent=?";
        $result = $this->doSelect($sql,[$id_category]);
        return $result;
    }
}