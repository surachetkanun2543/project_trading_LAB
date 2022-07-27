<?php
include("check.php");
header('Content-Type: charset=utf-8');
include('../../service/admin_connect.php');
include("fnc.php");
$status = "";
$msg = "";

if ($_POST['action'] == 'edit') {
    if (!empty($_POST['Assettype_id'])) {

        $Assettype_id = secureStr($_POST['Assettype_id']);
        $Assettype_id = $conn->escape_string($_POST['Assettype_id']);
        
        $sql = "select * from  tb_assettype where Assettype_id='" . $Assettype_id . "' limit 1 ";
        $rs = $conn->query($sql);
        $row = $rs->fetch_array();
        // encode คือการแปล array ในแบบ php เป็นในรูปแบบ json
        echo json_encode($row);
        exit();
    }
}

// delete function
if ($_POST['action'] == 'delete') {
    if (!empty($_POST['Assettype_id'])) {

        $Assettype_id = secureStr($_POST['Assettype_id']);
        $Assettype_id = $conn->escape_string($_POST['Assettype_id']);
        $sql = "delete from tb_assettype where Assettype_id='" . $Assettype_id . "' ";
        $rs = $conn->query($sql);
        if ($rs) {
            $status = "ok";
        } else {

            echo "<script type='text/javascript'>";
            echo "alert('ลบ ผิดพลาด');";
            echo "window.location = 'admin.php'; ";
            echo "</script>";
        }
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('ลบ ผิดพลาด');";
        echo "window.location = 'admin.php'; ";
        echo "</script>";
    }

    echo '{"status":"' . $status . '","msg":"' . $msg . '"}';
    exit();
}
if ($_POST['action'] == 'update') {
    if (!empty($_POST['txt_name'])) {

        $Assettype_id = secureStr($_POST['Assettype_id']);
        $Assettype_id = $conn->escape_string($_POST['Assettype_id']);
        $Assettype_name = secureStr($_POST['txt_name']);
        $Assettype_name =  $conn->escape_string($_POST['txt_name']);

        $sql = "UPDATE tb_assettype SET Assettype_name='$Assettype_name' WHERE Assettype_id='$Assettype_id' ";

        $rs = $conn->query($sql);


        if ($rs) {
            $status = "ok";
        } else {
            $msg = "แก้ไขข้อมูลไม่ได้ 1 ";
            echo "<script type='text/javascript'>";
            echo "alert('แก้ไข  ผิด');";
            echo "window.location = 'admin.php'; ";
            echo "</script>";
        }
    } else {
        $msg = "แก้ไขข้อมูลไม่ได้ 2 ";
        echo "<script type='text/javascript'>";
        echo "alert('แก้ไข ผิดพลาด');";
        echo "window.location = 'admin.php'; ";
        echo "</script>";
    }

    echo '{"status":"' . $status . '","msg":"' . $msg . '"}';
    exit();
}
if ($_POST['action'] == 'add') {
    if (!empty($_POST['txt_name'])) {

        $Assettype_id = secureStr($_POST['Assettype_id']);
        $Assettype_id = $conn->escape_string($_POST['Assettype_id']);
        $Assettype_name = secureStr($_POST['txt_name']);
        $Assettype_name =  $conn->escape_string($_POST['txt_name']);

        $sql = "INSERT INTO tb_assettype(Assettype_name) VALUES ('$Assettype_name')";

        $rs = $conn->query($sql);
        if ($rs) {
            $status = "ok";
            $msg = "สำเร็จ";
        } else {
            $status = "";
            $msg = "ผิดพลาด";
        }
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('Error back to upload again');";
        echo "window.location = 'admin.php'; ";
        echo "</script>";
    }
    echo '{"status":"' . $status . '","msg":"' . $msg . '"}';
    exit();
}
