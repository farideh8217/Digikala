<?php
$activeMenu='category';
require('views/admin/layout.php');
$category = $data["category"];


$parent_category = [];
 if (isset($data["parentcategory"])) {
     $parent_category = $data["parentcategory"];
     $parent_category = array_reverse($parent_category);
 }
$categoryInfo = [];
if (isset($data["categoryinfo"])) {
    $categoryInfo = $data["categoryinfo"];
}

?>
<style>
    .w400 {
        width: 600px;
    }
    .w200{
        width: 200px;
    }
</style>

<div class="left">

    <p class="title">
        مدیریت دسته ها

        (
        <?php foreach ($parent_category as $row) { ?>

          <a href="admincategory/showchildren/<?= $row["id"] ?>">
              <?= $row["title"] ?>
          </a>
            -

        <?php } ?>


        <a href="admincategory/<?php if (isset($categoryInfo['id'])) {
            echo 'showchildren/' . $categoryInfo['id'];
        } else {
            echo 'index';
        } ?>">
            <?php
            if (isset($categoryInfo['title'])) {
                echo $categoryInfo['title'];
            } else {
                echo 'دسته های اصلی';
            }
            ?>

        </a>

        )

    </p>


    <form action="admincategory/deletecategory/" method="post">
    <a class="btn_green_small" href="">
        افزودن
    </a>

    <a class="btn_red_small" onclick="submitForm();">
        حذف
    </a>



        <table class="list" cellspacing="0">

            <tr>
                <td>
                    ردیف
                </td>
                <td>
                    عنوان دسته
                </td>
                <td>
                    مشاهده زیردسته ها
                </td>

                <td>
                    ویرایش
                </td>
                <td>
                    ویژگی ها
                </td>

                <td>
                    انتخاب
                </td>
            </tr>

            <?php
            foreach ($category as $row) {


                ?>
                <tr>
                    <td>
                        <?= $row['id']; ?>
                    </td>
                    <td class="w200">
                        <?= $row['title']; ?>
                    </td>
                    <td>
                        <a href="admincategory/showchildren/<?= $row['id']; ?>">
                            <img src="public/images/view_icon.png" class="view">
                        </a>
                    </td>
                    <td>
                        <a href="admincategory/addcategory/<?= $row['id']; ?>/edit">
                            <img src="public/images/edit_icon.ico" class="view">
                        </a>
                    </td>

                    <td>
                        <a href="admincategory/showattr/<?= $row['id']; ?>">
                            مشاهده
                        </a>
                    </td>

                    <td>

                        <input type="checkbox" name="id[]" value="<?= $row['id']; ?>">
                    </td>
                </tr>


            <?php } ?>

        </table>

    </form>

</div>


</div>











