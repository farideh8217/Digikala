<?php
class model_admincategory extends Model{

    public $allchildrenIds = [];

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

    function add_category($title,$parent,$edit,$parentId)
    {
        if($edit == "") {
            $sql = "INSERT INTO `tbl_category`(`title`, `parent`) VALUES (?,?)";
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(1,$title);
            $stmt->bindParam(2,$parent);
            $insert = $stmt->execute();
            return $insert;
        }else{
            $sql = "UPDATE `tbl_category` SET `title`=?,`parent`=? where id=?";
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(1, $title);
            $stmt->bindParam(2, $parent);
            $stmt->bindParam(3, $parentId);
            $update = $stmt->execute();
            return $update;
        }
    }

    function get_childs($ids){
        $childrenId = [];
        foreach ($ids as $id) {
            $children = $this->get_children($id);
            foreach ($children as $child){
                array_push($childrenId,$child["id"]);
            }
        }
        return $childrenId;
    }
    function delete_category($ids=[])
    {
        $this->allchildrenIds = array_merge($this->allchildrenIds, $ids);
        while (sizeof($ids) > 0){
            $childrenIds = $this->get_childs($ids);
            $this->allchildrenIds = array_merge($this->allchildrenIds, $childrenIds);
            $ids = $childrenIds;
        }

        $x = implode(",",$this->allchildrenIds);

        $sql = "DELETE  FROM tbl_category WHERE id IN (" . $x . ")";
        var_dump($sql);
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
    }
}