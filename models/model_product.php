<?php
class model_product extends Model{
    public function __construct()
    {
        parent::__construct();
    }

    function product_info($id)
    {
        $sql = "SELECT * FROM tbl_product WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $price = $result["price"];
        $discount = $result["discount"];
        $price_calculate = $this->calculateDiscount($price,$discount);
        $result["price_discount"] = $price_calculate[0];
        $result["price_total"] = $price_calculate[1];

        $first_row = $result[0];
//        $sql = "SELECT * FROM tbl_option WHERE setting='special_time'";
//        $stmt = self::$conn->prepare($sql);
//        $stmt->execute();
//        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
//        $duration_special = (int)$result2["value"];
        $options = self::get_option();//بجای نوشتن کدهای بالا برای اینکه از تکرار جلوگیری کنیم از این روش استفاده می کنیم
        $duration_special = $options["special_time"];
        $time_end = $first_row["time_special"]+$duration_special;
        $date = date("F d,Y H:i:S",$time_end);
        $result['date_special'] = $date;

        return $result;
    }
}