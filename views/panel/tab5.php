<section>
    <table cellspacing="0">
        <tr>
            <td>ردیف</td>
            <td>تاریخ</td>
            <td>کالا</td>
            <td>می پسندم</td>
            <td>مشاهده</td>
            <td>ویرایش</td>
            <td>حذف</td>

        </tr>

        <php 
        $comments = $data['comments'];
        $i = 1;
        foreach ($comments as $row) {

            ?>
            <tr>
                <td><=php $i ?></td>
                <td><=php $row['tarikh'] ?></td>
                <td><=php $row['productTitle'] ?></td>
                <td><=php $row['likecount'] ?></td>
                <td>
                    <a href="product/index/<=php $row['idproduct'] ?>/nazar#comment<=php $row['id'] ?>">
                        <img src="public/images/View.gif">
                    </a>
                </td>
                <td><a href="addcomment/index/<=php $row['idproduct'] ?>">
                        <img src="public/images/Edit.gif">
                    </a></td>
                <td>
                    <img onclick="deleteComment(<=php $row['id'] ?>,this)" style="cursor: pointer;"
                         src="public/images/Delete.gif">
                </td>

            </tr>

            <php 
            $i++;
        } ?>

    </table>
</section>


<script>
    function deleteComment(commentId, tag) {

        var imgTag = $(tag);
        var parentTag = imgTag.parents('tr');

        var url = 'panel/deletecomment/' + commentId;
        var data = {};
        $.post(url, data, function (msg) {

            parentTag.remove();
        })

    }
</script>
















































