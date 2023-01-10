<?php
class Model{
    public static $conn ='';
    public function __construct()
    {

    }

    public static function get_option()//چون فوتر در همه ی قسمت ها هست ما فانکشن را اینجا مینویسیم که درهمه ی صفحات تکرار نشه
    {
        $sql = "SELECT * FROM tbl_option";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $option = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $option_new =[];
        foreach ($option as $option_item){
            $setting = $option_item["setting"];
            $value = $option_item["value"];
            $option_new[$setting] = $value;
        }
        return $option_new;
    }

    function calculateDiscount($price,$discount)
    {
        $price_discount = ($discount*$price)/100;//میزان تخفیف مثلا 10درصد هزارتومن میشه 100تومن تخفیف
        $price_total = $price-$price_discount;//قیمت نهایی
        return [$price_discount,$price_total];
    }

    function doSelect($sql, $values = array(), $fetch = '', $fetchStyle = PDO::FETCH_ASSOC)
    {

        $stmt = self::$conn->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        $stmt->execute();
        if ($fetch == '') {
            $result = $stmt->fetchAll($fetchStyle);
        } else {
            $result = $stmt->fetch($fetchStyle);
        }
        return $result;
    }

    function doquery($sql, $values = array())
    {
        $stmt = self::$conn->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        $stmt->execute();
    }
}