<?php
class model_product extends Model{
    public function __construct()
    {
        parent::__construct();
    }

    function product_info($id)
    {
        $sql = "SELECT * FROM tbl_product WHERE id = :id";
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
        foreach ($colors as $color) {
            $color_info = $this->color_info($color);
            print_r($color);
        }
        return $result;
    }

    function color_info($id)
    {
        $sql = "SELECT * FROM tbl_color WHERE id=?";
        $result = $this->doSelect($sql,[$id],1);
        return $result;
    }
}