<?php
class model_adminproduct extends model
{

    function get_product()
    {
        $sql = "SELECT * FROM tbl_product";
        $result = $this->doSelect($sql);
        return $result;
    }

    function get_category()
    {
        $sql = "SELECT * FROM tbl_category";
        $result = $this->doSelect($sql);
        return $result;
    }

    function get_color()
    {
        $sql = "SELECT * FROM tbl_color";
        $result = $this->doSelect($sql);
        return $result;
    }

    function get_garantee()
    {
        $sql = "SELECT * FROM tbl_garantee";
        $result = $this->doSelect($sql);
        return $result;
    }

    function add_product($data = [],$productId)
    {
        $title = $data["title"];
        $categoryId = $data["categoryId"];
        $price = $data["price"];
        $introduction = $data["introduction"];
        $discount = $data["discount"];
        $tedat_mojood = $data["tedad_mojood"];
        $colors = $data["color"];
        $garantee = $data["garantee"];

        if($productId == ""){
            $sql = "INSERT INTO `tbl_product`(`title`, `price`, `cat`, `introduction`, `tedad_mojood`, `discount`) VALUES (?,?,?,?,?,?)";
            $value = [$title, $price, $categoryId, $introduction, $tedat_mojood, $discount];
            $this->doquery($sql, $value);
            $result = model::$conn->lastInsertId();

            foreach ($colors as $color){
                $sql ="INSERT INTO `tbl_color_product`(`id_product`, `id_color`) VALUES (?,?)";
                $value = [$result,$color];
                $this->doquery($sql, $value);
            }

            foreach ($garantee as $garantee){
                $sql = "INSERT INTO `tbl_garantee_product`(`id_garantee`, `id_product`) VALUES (?,?)";
                $value = [$garantee,$result];
                $this->doquery($sql, $value);
            }
        }else{
            $sql = "UPDATE `tbl_product` SET `title`=?,`price`=?,`cat`=?,`introduction`=?,`tedad_mojood`=?,`discount`=? WHERE id=?";
            $value = [$title, $price, $categoryId, $introduction, $tedat_mojood, $discount,$productId];
            $this->doquery($sql, $value);

            foreach ($colors as $color){
                $sql = "UPDATE `tbl_color_product` SET `id_color`=? where `id_product`=?";
                $value = [$color,$productId];
                $this->doquery($sql, $value);
            }

            foreach ($garantee as $garantee) {
                $sql= "UPDATE `tbl_garantee_product` SET `id_garantee`=? WHERE `id_product`=?";
                $value = [$garantee,$productId];
                $this->doquery($sql, $value);
            }

        }
    }

    function get_product_info($productId)
    {
        $sql = "SELECT * FROM tbl_product WHERE id=?";
        $result = $this->doSelect($sql,[$productId],1);
        return $result;
    }

    function get_color_info($productId)
    {
        $sql = "SELECT id_color FROM `tbl_color_product` WHERE id_product=?";
        $result = $this->doSelect($sql,[$productId]);
        foreach ($result as $id_color){
            $sql = "SELECT  `title`, `hex` FROM `tbl_color` WHERE id=?";
            $result = $this->doSelect($sql,[$id_color],1);
            return $result;
        }
        return $result;
    }
}