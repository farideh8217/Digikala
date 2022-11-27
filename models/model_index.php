<?php
class model_index{
    public function __construct()
    {
        $database = [
            'host'=>'localhost',
            'dbname'=>'digikala',
            'user'=>'root',
            'pass'=>''
        ];
        try {
            $this->conn = new PDO("mysql:host={$database['host']};dbname={$database['dbname']}", $database['user'], $database['pass']);
        } catch (PDOException $e) {
            exit("An error happend, Error: " . $e->getMessage());
        }
    }

    public function get_slider1(){

        $sql = "SELECT * FROM tbl_slider1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_slider2(){

        $sql = "SELECT * FROM tbl_product WHERE special=1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $first_row = $result[0];
        $time_end = $first_row["time_special"]+(24*3600);
        $date = date("F d,Y H:i:S",$time_end);
        return [$result,$date];
    }
}