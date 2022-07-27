<?php
include('./service/admin_connect.php');
$page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
if (!empty($_POST['q_name'])) {
    $sql_search = " WHERE p_name LIKE '%" . $_POST['q_name'] . "%' OR  Assettype_name  LIKE '%" . $_POST['q_name'] . "%'";
} else {
    $sql_search = '';
}
$sql = ("SELECT * FROM tbl_product as p INNER JOIN tb_assettype as t on p.Assettype_id=t.Assettype_id $sql_search ORDER BY p_id DESC  "); // limit เริ่มที่ , จำนวนที่ต้องการแสดง
$result = $conn->query($sql);
?>

<h1 style="font-size:18px;color: black;">รายการสินค้าตาม ชื่อ / หมวดหมู่ : <?php echo  $_POST['q_name']  ?></h1>
<hr>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
?>

        <style>
            .img-responsive {
                transition: transform .7s;
                /* Animation */
            }

            .img-responsive:hover {
                -ms-transform: scale(1.4);
                /* IE 9 */
                -webkit-transform: scale(1.4);
                /* Safari 3-8 */
                transform: scale(1.4);
                /* Animation */
            }
        </style>
        <div class="row">
            <div class="card" style="width: 18rem;">
                <div class="card">
                    <div class="card-body">
                        <img class="card-img-top" src="admin/p_img/<?php echo $row["p_img"]; ?>">
                        <p class="card-text">>ชื่อ : <?php echo $row['p_name']; ?> </h2>
                        <p class="card-text">>หมวดหมู่ : <?php echo $row['Assettype_name']; ?> </h2>
                        </p>
                        <a href="#" class="btn btn-primary">฿ <?php echo $row['p_price']; ?> บาท</h2></a>
                        <input type="hidden" name="p_id" value="<?php echo $row["p_id"]; ?>" /><br>
                        <input type="hidden" name="p_name" value="<?php echo $row["p_name"]; ?>" />
                        <a name="p_id" href="product_detail.php?act=detail&ID= <?php echo $row[0]; ?>" class="btn btn-warning btn-lg  shadow p-2 m-2"> รายละเอียด</a>
                    </div>
                </div>
            </div>
        </div>


<?php
    }
}
?>