<?php
require('views/admin/layout.php');



//$edit=$data['edit'];



?>
<div class="left">

    <p class="title">
        <php  if($edit==''){ ?>
        ایجاد دسته جدید

        <php  }else{ ?>
        ویرایش دسته
        <php  } ?>

        <style>
            .row {
                width: 100%;
                float: right;
                margin-top: 5px;
            }

            .span_title {
                display: inline-block;
                width: 150px;
                font-size: 10pt;
            }

            input {
                width: 200px;
                height: 24px;
                border: 1px solid #eee;
            }

            select {
                font-family: yekan;
                height: 32px;
                line-height: 30px;
                padding: 2px;

            }

            option {
                padding: 2px;
                font-family: yekan;
                font-size: 10pt;
            }
        </style>

    <form action="admincategory/addcategory" method="POST">

        <div class="row">

        <span class="span_title">
عنوان دسته:
        </span>
<!--            <php  if($edit==''){}else{echo $categoryInfo['title'];} ?>-->
            <input type="text" name="title" value="">

        </div>
        <div class="row">

        <span class="span_title">
دسته والد:
        </span>
            <select name="parent" >
<!--                --><?php //$all_category = $data["allcategory"] ;
//                    foreach ($all_category as $category_item){?>
<!--                        <option --><?php //if ($allcategory_item["id"] == $parentid) print "selected" ?><!-->-->
<!--                            --><?//= $category_item["title"] ?>
<!--                        </option>-->
<!--                   --><?php //} ?>
            </select>

        </div>


        <button name="submit">اجرای عملیات</button>
        <h4>
            <?php
            $error = [];
            if (isset($data["error"])) {
                $error = $data["error"];
                echo $error;
            } ?>
        </h4>

    </form>


</div>


</div>











