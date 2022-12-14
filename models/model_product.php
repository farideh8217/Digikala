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

    function comment_param($id_category,$id)
    {
        $sql = "SELECT * FROM tbl_comment_param where id_category=?";
        $param = [$id_category];
        $result = $this->doSelect($sql,$param);

        $sql = "SELECT * FROM tbl_comment WHERE id_product=?";
        $result2 = $this->doSelect($sql,[$id]);
        $score_total = [];
        foreach ($result2 as $row){
            $param_score = $row["param"];
            $param_score = unserialize($param_score);
            foreach ($param_score as $key=>$value) {
                $param_id = $key;
                $score = $value;
                if(!isset($score_total[$param_id])) {
                    $score_total[$param_id] = 0;
                }
                $score_total[$param_id] = $score_total[$param_id]+$score;
            }

        }
        $total_comment = sizeof($result2);
        foreach ($score_total as $key=>$value){
            $value = $value/$total_comment;
            $score_total[$key] = $value;
        }

        return [$result,$score_total];
    }

    function get_comment($id)
    {
        $sql = "SELECT * FROM tbl_comment where id_product=?";
        $param = [$id];
        $result = $this->doSelect($sql,$param);
        return $result;
    }

    function get_question($id)
    {
        $sql = "SELECT * FROM tbl_question where id_product=? and parent=0";
        $param = [$id];
        $result = $this->doSelect($sql,$param);
        foreach ($result as $key => $value) {
            $sql = "SELECT * FROM tbl_question where parent=?";
            $data = [$value["id"]];
            $result2 = $this->doSelect($sql,$data,1);
            $result[$key]["childrens"] = $result2;
        }
        return $result;
    }
}