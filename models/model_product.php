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


        $colors = $result["colors"];
        $colors = explode(",",$colors);
        $colors = array_filter($colors);
        $all_colors = [];
        foreach ($colors as $color) {
            $color_info = $this->color_info($color);
            array_push($all_colors,$color_info);//مقداری را به ارایه اضافه کنیم
        }
        $result["all_colors"] = $all_colors;

        //////////////////////////////////////////////////////////////////////////
        $garantee = $result["garantee"];
        $garantes = explode(",",$garantee);
        $garantee = array_filter($garantes);
        $all_garantee = [];
        foreach ($garantee as $id_garantee) {
            $garantee_info =$this->garantee_info($id_garantee);
            array_push($all_garantee,$garantee_info);
        }
        $result["all_garantee"] = $all_garantee;

        return $result;
    }


    function garantee_info($id)
    {
        $sql = "SELECT * FROM tbl_garantee WHERE id=?";
        $result = $this->doSelect($sql,array($id),1);
        return $result;
    }

    function color_info($id)
    {
        $sql = "SELECT * FROM tbl_color WHERE id=?";
        $result = $this->doSelect($sql,array($id),1);
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
        $sql = "SELECT * FROM tbl_attr WHERE id_category=? and parent=0";
        $result = $this->doSelect($sql,[$id_category]);
        foreach ($result as $key=>$row) {
            $sql = "SELECT tbl_attr.title,tbl_product_attr.value FROM tbl_attr left join tbl_product_attr ON
            tbl_attr.id = tbl_product_attr.id_attr and tbl_product_attr.id_product=? where tbl_attr.parent=?";
            $param = [$id,$row["id"]];
            $result2 = $this->doSelect($sql,$param);
            $result[$key]["children"] = $result2;
        }
        return $result;
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