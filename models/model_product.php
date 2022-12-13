<?php
class model_product extends Model{
    public function __construct()
    {
        parent::__construct();
    }

    function product_info($id)
    {
        $sql = "SELECT * FROM tbl_product WHERE id = ?";
        $result = $this->doSelect($sql, array($id), 1);

        $price = $result["price"];
        $discount = $result["discount"];
        $price_calculate = $this->calculateDiscount($price,$discount);
        $result["price_discount"] = $price_calculate[0];
        $result["price_total"] = $price_calculate[1];

        $first_row = $result;
        $time_special = $first_row['time_special'];
//        $sql = "SELECT * FROM tbl_option WHERE setting='special_time'";
//        $stmt = self::$conn->prepare($sql);
//        $stmt->execute();
//        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
//        $duration_special = (int)$result2["value"];
        $options = self::get_option();//بجای نوشتن کدهای بالا برای اینکه از تکرار جلوگیری کنیم از این روش استفاده می کنیم
        $duration_special = $options["special_time"];
        $time_end = $time_special+$duration_special;
        $date = date("F d,Y H:i:S",$time_end);
        $result['date_special'] = $date;

        return $result;
    }


    function garantee_info($id)
    {
        $sql = "SELECT tbl_garantee.*,tbl_garantee_product.* FROM tbl_garantee INNER JOIN tbl_garantee_product ON tbl_garantee.id=tbl_garantee_product.id_garantee WHERE tbl_garantee_product.id_product=?";
        $result = $this->doSelect($sql,array($id));
        return $result;
    }

    function color_info($id)
    {
        $sql = "SELECT tbl_color.*,tbl_color_product.* FROM tbl_color INNER JOIN tbl_color_product ON tbl_color.id=tbl_color_product.id_color WHERE tbl_color_product.id_product=?";
        $result = $this->doSelect($sql,array($id));
        return $result;
    }

    function onlyclicksite()
    {
        $sql = "SELECT * FROM tbl_product WHERE onlyclicksite=1";
        $result = $this->doselect($sql);
        return $result;
    }

    function naghd($id)
    {
        $sql = "SELECT * FROM tbl_naghd WHERE id_product=?";
        $result = $this->doselect($sql,[$id]);
        return $result;
    }

    function fani($id,$id_category)
    {
        
    }

    function comment_param($id_category)
    {
        $sql = "SELECT * FROM tbl_comment_param where id_category=?";
        $param = [$id_category];
        $result = $this->doSelect($sql,$param);
        return $result;
    }

    function get_comment($id)
    {
        $sql = "SELECT * FROM tbl_comment where id_product=?";
        $param = [$id];
        $result = $this->doSelect($sql,$param);
        return $result;
    }

}