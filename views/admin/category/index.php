<php 
$activeMenu='category';
require('views/admin/layout.php');
$category = $data['category'];

$categoryInfo = array();
if (isset($data['categoryInfo'])) {
    $categoryInfo = $data['categoryInfo'];
}
$parents = array();
if (isset($data['parents'])) {
    $parents = $data['parents'];
    $parents = array_reverse($parents);
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
        <php  foreach ($parents as $row) { ?>

            <a href="admincategory/showchildren/<=php $row['id']; ?>">
                <=php $row['title']; ?>
            </a>
            -

        <php  } ?>


        <a href="admincategory/<php  if (isset($categoryInfo['id'])) {
            echo 'showchildren/' . $categoryInfo['id'];
        } else {
            echo 'index';
        } ?>">
            <php 
            if (isset($categoryInfo['title'])) {

                echo $categoryInfo['title'];
            } else {
                echo 'دسته های اصلی';
            }
            ?>


        </a>
        )

    </p>


    <a class="btn_green_small" href="admincategory/addcategory/<=php @$categoryInfo['id']; ?>">
        افزودن
    </a>

    <a class="btn_red_small" onclick="submitForm();">
حذف
    </a>

    <form action="admincategory/deletecategory/<=php @$categoryInfo['id'];  ?>" method="post">

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

        <php 
        foreach ($category as $row) {

            ?>
            <tr>
                <td>
                    <=php $row['id']; ?>
                </td>
                <td class="w200">
                    <=php $row['title']; ?>
                </td>
                <td>
                    <a href="admincategory/showchildren/<=php $row['id']; ?>">
                        <img src="public/images/view_icon.png" class="view">
                    </a>
                </td>
                <td>
                    <a href="admincategory/addcategory/<=php $row['id']; ?>/edit">
                        <img src="public/images/edit_icon.ico" class="view">
                    </a>
                </td>

                <td>
                    <a href="admincategory/showattr/<=php $row['id']; ?>">
                        مشاهده
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











