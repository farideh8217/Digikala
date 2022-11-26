<php 

$activeMenu='order';

require('views/admin/layout.php');

$orders = $data['orders'];


?>
<style>
    .w400 {
        width: 600px;
    }
</style>

<div class="left">

    <p class="title">
        <a>
            مدیریت سفارشات
        </a>


    </p>


    <a class="btn_red_small" onclick="submitForm();">
        حذف
    </a>

    <form action="adminorder/delete" method="post">

        <table class="list" cellspacing="0">

            <tr>
                <td>
                    کد
                </td>
                <td>
                    تاریخ
                </td>

                <td style="width: 350px;">
                    تحویل گیرنده
                </td>
                <td>
                    مبلغ کل
                </td>
                <td>
                    استان
                </td>
                <td>
                    شهر
                </td>

                <td>
جزییات
                </td>


                <td>
                    انتخاب
                </td>
            </tr>

            <php 
            foreach ($orders as $row) {

                ?>
                <tr>
                    <td>
                        <=php $row['id']; ?>
                    </td>
                    <td>
                        <=php $row['tarikh']; ?>
                    </td>
                    <td>
                        <=php $row['family']; ?>
                    </td>
                    <td>
                        <=php $row['amount']; ?>
                    </td>
                    <td>
                        <=php $row['ostan']; ?>
                    </td>
                    <td>
                        <=php $row['city']; ?>
                    </td>

                    <td>
                        <a href="adminorder/detail/<=php $row['id']; ?>">
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











