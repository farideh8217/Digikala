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

    function get_children($id_category){
        $sql= "SELECT * FROM tbl_category WHERE parent=?";
        $result = $this->doSelect($sql,[$id_category]);
        return $result;
    }
    function category_info($id_category)
    {
        $sql= "SELECT * FROM tbl_category WHERE id=?";
        $result = $this->doSelect($sql,[$id_category],1);
        return $result;
    }
    function get_parent_category($id_category)
    {
        $categoryInfo = $this->category_info($id_category);
        $parent = $categoryInfo["parent"];
        $parent_cat = [];
        while ($parent != 0) {
            $sql = "SELECT * FROM tbl_category WHERE id=?";
            $result = $this->doSelect($sql,[$parent],1);
            array_push($parent_cat,$result);
            $parent = $result["parent"];
        }
        return $parent_cat;
    }

    function all_category(){
        $sql = "SELECT * FROM tbl_category";
        $result = $this->doSelect($sql);
        return $result;
    }

    function add_category($title,$parent)
    {
        $sql = "INSERT INTO `tbl_category`(`title`, `parent`) VALUES (?,?)";
        $stmt = self::$conn->prepare($sql);
        $stmt->bindParam(1,$title);
        $stmt->bindParam(2,$parent);
        $stmt->execute();
    }
}