<?php
error_reporting(0);
ini_set('display_errors', 0);
include('../../service/admin_connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <title>หน้าจัดการแบบประเมินความเสี่ยง</title>

    <script language-="javascript">
        $().ready(function() {
            swal({
                position: 'top-left',
                buttons: false,
                title: 'ยินดีต้อนรับเข้าสู่',
                text: "หน้าจัดการแบบประเมินความเสี่ยง",
                timer: 700
            })
            show(1);
            // search
            $('.view_data').ready(function() {
                $('#dataModal').modal('show');
            })

        });
    </script>
</head>
<nav>
    <?php include('nav.php') ?>
</nav>

<body>
    <div class="container">
        <div class="card-body col-8">
            <h1 class="h3 font-weight-bold m-3" style="color: black;">หน้าจัดการแบบประเมินความเสี่ยง</h1>
            <hr />
            <div class="container-fluid col-12">
                <div class="s128">
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped shadow mb-3 ">
            <table class="table">
                <tr>
                    <td colspan="8" bgcolor="#000000" align="center" style='color: white;'>สรุปผลแบบประเมินความเสี่ยง</td>
                    </td>
                </tr>
                <tr>
                    <td colspan="8" align="center" bgcolor="#CCCCCC"></td>
                </tr>
                <tr>
                    <td width="104">&nbsp;</td>
                    <td width="326">&nbsp;</td>
                    <td width="263">&nbsp;</td>
                    <td width="72">&nbsp;</td>
                    <td width="72">&nbsp;</td>
                    <td width="75">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center" bgcolor="#33CCFF">เพศ</td>
                    <td align="center" bgcolor="#33CCFF">จำนวน(คน)</td>
                    <td align="center" bgcolor="#33CCFF" style="color: black ;"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <?php

                    $query = "SELECT gender, COUNT(id_info) as qtys FROM tb_info GROUP BY gender";
                    $result = mysqli_query($conn, $query);


                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <td>&nbsp;</td>
                        <td><?= $row['gender']; ?></td>
                        <td><?= $row['qtys']; ?>  : คน </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                </tr>




            <?php } ?>
            <tr>
                <?php

                $query = "SELECT COUNT(id_info) as qty FROM tb_info ";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <td>&nbsp;</td>
                    <td>รวม</td>
                    <td><?= $row['qty']; ?>  : คน</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
            </tr>
        <?php } ?>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center" bgcolor="#FFCC99">อายุ</td>
            <td align="center" bgcolor="#FFCC99">จำนวน(คน)</td>
            <td align="center" bgcolor="#FFCC99" style="color: black ;"></td>

            <td> &nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <?php

            $query = "SELECT age, COUNT(id_info) as qtyage FROM tb_info GROUP BY age";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) {
            ?>
                  <td>&nbsp;</td>
                        <td><?= $row['age']; ?></td>
                        <td><?= $row['qtyage']; ?>  : คน</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
        </tr>
    <?php } ?>

    <tr>

        <?php

        $query = "SELECT COUNT(id_info) as qty FROM tb_info ";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
        ?>
           <td>&nbsp;</td>
                    <!-- <td>รวม</td> -->
                    <!-- <td><?= $row['qty']; ?></td> -->
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
        <?php } ?>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align="center" bgcolor="#CCCCFF" style="color: black ;">สถานภาพ</td>
        <td align="center" bgcolor="#CCCCFF" style="color: black;">จำนวน(คน)</td>
        <td align="center" bgcolor="#CCCCFF" style="color: black ;"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <?php

        $query = "SELECT status, COUNT(id_info) as qtystatus FROM tb_info GROUP BY status";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
        ?>
            <td>&nbsp;</td>
            <td><?= $row['status']; ?></td>
            <td><?= $row['qtystatus']; ?>  : คน</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
    </tr>
<?php } ?>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

            </table>
</body>

</html>