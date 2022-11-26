<php 
require('views/admin/layout.php');

$naghd = $data['naghd'];
$productInfo = $data['productInfo'];



?>
<style>
    .w400 {
        width: 600px;
    }
</style>

<div class="left">

    <p class="title">
        <a>
مدیریت نقد وبررسی
        </a>
        <span style="color: red;">
            (
            <=php $productInfo['title']; ?>
            )
        </span>


    </p>



    <a class="btn_green_small" href="adminproduct/addnaghd/<=php $productInfo['id']; ?>">
افزودن
    </a>

    <a class="btn_red_small" onclick="submitForm();">
        حذف
    </a>


    <form action="adminproduct/deletenaghd/<=php $productInfo['id']; ?>" method="post">

        <table class="list" cellspacing="0">

            <tr>

                <td>
                    عنوان
                </td>

                <td>
                    ویرایش
                </td>


                <td>
                    انتخاب
                </td>
            </tr>

            <php 
            foreach ($naghd as $row) {

                ?>
                <tr>

                    <td class="w400">
                        <=php $row['title']; ?>
                    </td>

                    <td>
                        <a href="adminproduct/addnaghd/<=php $row['idproduct']?>/<=php $row['id']?>">
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











