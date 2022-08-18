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

    <title>Document</title>

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
            $('#btsearch').click(function() {
                show(1);
            });

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
        <div class="card-body col-12">
            <h1 class="h3 font-weight-bold m-3" style="color: black;">หน้าจัดการแบบประเมินความเสี่ยง</h1>
            <hr />
            <div class="container-fluid col-12">


                <div class="s128">
                    <form action="javascript:;" method="post">
                        <div class="inner-form">
                            <div class="row">
                                <div class="input-field first">
                                    <!-- <input style="font-family: 'Athiti', sans-serif;" type="search" name="q_name" id="q_name" placeholder="ค้นหา"><br>&ensp; -->
                                    <!-- <a class='btn btn-outline btn-lg ' name="dataModal"id="dataModal" style="color:lightgrey;" href="questions.php?act=add"><i class="fa fa-plus"></i> </a> -->
                                    <!-- <button type="button" style="color:lightgrey;" class='btn btn-outline btn-lg view_data' data-toggle="modal" data-target="#dataModal"><i class="fa fa-plus"></i></button> -->
                                    <!-- <button style="display: none;" id="btsearch" type="submit">ค้นหา</button> -->
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped shadow mb-3 ">
        <table class="table">

            <tr>
                <td colspan="6" bgcolor="#000000" align="center" style='color: white;'>สรุปผลแบบประเมินความเสี่ยง</td>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" bgcolor="#CCCCCC">ตอนที่ 1 ข้อมูลพื้นฐาน</td>
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
                // Make a MySQL Connection


                $query = "SELECT gender, COUNT(id_person) as qty FROM tb_person GROUP BY gender";
                $result = mysqli_query($conn, $query);


                // Print out result
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <td>&nbsp;</td>
                    <td><?= $row['gender']; ?></td>
                    <td><?= $row['qty']; ?></td>
                    <td></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
            </tr>
        <? } ?>
        <tr>
            <?php
            // Make a MySQL Connection

            $query = "SELECT COUNT(id_person) as qty FROM tb_person ";
            $result = mysqli_query($conn, $query);


            // Print out result
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <td>&nbsp;</td>
                <td align="center">รวม</td>
                <td><?= $row['qty']; ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            <? } ?>
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
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <?php
            // Make a MySQL Connection

            include("conn.php");
            $query = "SELECT age, COUNT(id_person) as qtyage FROM tb_person GROUP BY age";
            $result = mysqli_query($conn, $query);

            // Print out result
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <td>&nbsp;</td>
                <td><?= $row['age']; ?></td>
                <td><?= $row['qtyage']; ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
        </tr>
    <? } ?>

    <tr>

        <?php
        // Make a MySQL Connection

        $query = "SELECT COUNT(id_person) as qty FROM tb_person ";
        $result = mysqli_query($conn, $query);


        // Print out result
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <td>&nbsp;</td>
            <td align="center">รวม</td>
            <td><?= $row['qty']; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        <? } ?>
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
        // Make a MySQL Connection



        $query = "SELECT status, COUNT(id_person) as qtystatus FROM tb_person GROUP BY status";
        $result = mysqli_query($conn, $query);


        // Print out result
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <td>&nbsp;</td>
            <td><?= $row['status']; ?></td>
            <td><?= $row['qtystatus']; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
    </tr>
<? } ?>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
</tr>
<tr>
    <td>&nbsp;</td>
    <td align="center" bgcolor="#343A40" style="color: white ;">รายการ</td>
    <td align="center" bgcolor="#343A40" style="color: white ;">คะแนนเฉลี่ย</td>
    <td align="center" bgcolor="#343A40" style="color: white ;">ระดับ</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <?php
    // Make a MySQL Connection
    include("conn.php");
    $query =
        "SELECT tb_question.*,tb_answer.id_question, sum(tb_answer.score) 
      as qtyscore ,count(tb_answer.id_person) as qtyperson  
      FROM tb_answer 
      LEFT JOIN tb_question 
      ON tb_answer.id_question = tb_question.id_question 
      GROUP BY tb_answer.id_question";

    $result = mysqli_query($conn, $query);


    // Print out result
    while ($row = mysqli_fetch_array($result)) {

    ?>
        <td>&nbsp;</td>
        <td><?= $row['question']; ?></td>
        <td align="center"><?= number_format(($row['qtyscore'] / $row['qtyperson']), 2); ?></td>
        <td align="center"><?
                            $answer = (number_format(($row['qtyscore'] / $row['qtyperson']), 2));

                            if ($answer >= 3.60) {
                                //   echo "<script> window.location.href = 'up.php';</script>";
                                echo  "มาก";
                            } else if ($answer >= 3.30) {
                                //  echo "<script> window.location.href = 'st.php';</script>";
                                echo "กลาง";
                            } else if ($answer >= 2.10) {
                                //  echo "<script> window.location.href = 'low.php';</script>";
                                echo "น้อย";
                            }
                            ?></td>
        <td></td>
        <td></td>

</tr>
<? } ?>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
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