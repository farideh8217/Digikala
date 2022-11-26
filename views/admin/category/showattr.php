<php 
require('views/admin/layout.php');
$attr = $data['attr'];
$categoryInfo = $data['categoryInfo'];
$attrInfo = $data['attrInfo'];

?>
<style>
    .w400 {
        width: 600px;
    }

    .w200 {
        width: 200px;
    }
</style>

<div class="left">

    <p class="title">

        مدیریت ویژگی ها


        <a style="color:red;" href="admincategory/showattr/<=php $categoryInfo['id'] ?>">
            (
            دسته
            <=php $categoryInfo['title'] ?>


        </a>

        <php  if (isset($attrInfo['id'])) { ?>
            <span style="color:red;">
                            -
ویژگی:
                <=php $attrInfo['title'] ?>
        </span>

        <php  } ?>

        )


    </p>


    <a class="btn_green_small" href="admincategory/addattr/<=php $categoryInfo['id'] ?>/<=php $attrInfo['id'] ?>">
        افزودن
    </a>

    <a class="btn_red_small" onclick="submitForm();">
        حذف
    </a>

    <form action="admincategory/deleteattr/<=php $categoryInfo['id'] ?>/<=php $attrInfo['id'] ?>" method="post">

        <table class="list" cellspacing="0">

            <tr>
                <td>
                    ردیف
                </td>
                <td style="width: 400px;">
                    عنوان ویژگی
                </td>

                <php  if (!isset($attrInfo['id'])) { ?>
                    <td>
                        مشاهده زیرویژگی ها
                    </td>
                <php  } ?>

                <td>
                    مقادیر پیش فرض
                </td>

                <td>
                    ویرایش
                </td>

                <td>
                    انتخاب
                </td>
            </tr>

            <php 
            foreach ($attr as $row) {

                ?>
                <tr>
                    <td>
                        <=php $row['id']; ?>
                    </td>
                    <td class="w200">
                        <=php $row['title']; ?>
                    </td>

                    <php  if (!isset($attrInfo['id'])) { ?>
                        <td>
                            <a href="admincategory/showattr/<=php $categoryInfo['id']; ?>/<=php $row['id'] ?>">
                                مشاهده
                            </a>
                        </td>
                    <php  } ?>

                    <td>
                        <a href="admincategory/attrval/<=php $row['id']; ?>">
                            مقادیر پیش فرض
                        </a>

                    </td>

                    <td>
                        <a href="admincategory/addattr/<=php $categoryInfo['id'] ?>/<=php $attrInfo['id'] ?>/<=php $row['id'] ?>">
                            <img src="public/images/edit_icon.ico" class="view">
                        </a>
                    </td>


                    <td>

                        <input type="checkbox" name="id[]" value="<=php $row['id']; ?>">
                    </td>
                </tr>


            <php  } ?>

        </table>

    </form>

</div>


</div>











