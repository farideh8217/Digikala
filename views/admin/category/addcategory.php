<?php
require('views/admin/layout.php');

$edit = [];
if (isset($data["edit"])) {
    $edit = $data["edit"];
}

$categoryInfo = [];
if (isset($data["category_info"])) {
    $categoryInfo = $data["category_info"];
}

?>
<div class="left">

    <p class="title">
        <?php  if($edit==''){ ?>
        ایجاد دسته جدید

        <?php  }else{ ?>
        ویرایش دسته
        <?php  } ?>

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

    <form action="admincategory/addcategory/<?php if(isset($categoryInfo['id'])) echo $categoryInfo['id'] ?>/<?php if (isset($edit)) echo $edit?>" method="POST">

        <div class="row">

        <span class="span_title">
عنوان دسته:
        </span>

            <input type="text" name="title" value="<?php if($edit==''){}else{ if (isset($categoryInfo['title'])) echo $categoryInfo['title'];}?>">

        </div>
        <div class="row">

        <span class="span_title">
دسته والد:
        </span>
            <select name="parent" >
                <?php $all_category = $data["allcategory"];
                      $parentid = $data["parenId"];
                      if($edit == "") {
                          $selected = $parentid;
                      }else{
                          $selected = $category_info["parent"];
                      }
                    foreach ($all_category as $category_item){?>
                    <option <?php if ($category_item["id"] == $selected) print "selected"; ?> value="<?= $category_item["id"]?>" ><?= $category_item["title"] ?></option>
                <?php } ?>
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











