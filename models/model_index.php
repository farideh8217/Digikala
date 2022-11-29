<?php
class model_index extends Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function get_slider1(){

        $sql = "SELECT * FROM tbl_slider1";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_slider2(){

        $sql = "SELECT * FROM tbl_product WHERE special=1";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        foreach ($result as $key=>$value){
            $discount = $value["discount"];
            $price = $value["price"];
            $total_price = ((100-$discount)*$price)/100;
            /*
             * سطرجدید به جدول اضافه کردیم که مقدار تخفیف را حساب کند
             */
            $result[$key]['total_price'] = $total_price;
        }

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

        return [$result,$date];
    }

    function onlyclicksite()
    {
        $sql = "SELECT * FROM tbl_product WHERE onlyclicksite=1";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function mostview()
    {
        $sql = "SELECT * FROM tbl_option WHERE setting = 'limit_slider'";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
        $limit = $result2["value"];

        $sql = "SELECT * FROM `tbl_product` order by `view` DESC LIMIT ".$limit." ";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function last_product()
    {
        $sql = "SELECT * FROM tbl_option WHERE setting = 'limit_slider'";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
        $limit = $result2["value"];

        $sql = "SELECT * FROM `tbl_product` order by `id` DESC LIMIT ".$limit."";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}