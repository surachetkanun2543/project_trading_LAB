<?php
include("check.php");
header('Content-Type: charset=utf-8');
include('../../service/admin_connect.php');
include("fnc.php");
$status = "";
$msg = "";

if ($_POST['action'] == 'edit') {
    if (!empty($_POST['id'])) {

        $id = secureStr($_POST['id']);
        $id = $conn->escape_string($_POST['id']);
        $sql = "select * from  tb_user where id='" . $id . "' limit 1 ";
        $rs = $conn->query($sql);
        $row = $rs->fetch_array();
        echo json_encode($row);
        exit();
    }
}

// delete function
if ($_POST['action'] == 'delete') {
    if (!empty($_POST['id'])) {

        $id = secureStr($_POST['id']);
        $id = $conn->escape_string($_POST['id']);
        $sql = "delete from tb_user where id='" . $id . "' ";
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
    if (!empty($_POST['txt_user'])) {

        $id = secureStr($_POST['id']);
        $name =  secureStr($_POST['txt_user']);
        $email = secureStr($_POST['txt_email']);

        $id = $conn->escape_string($_POST['id']);
        $name =  $conn->escape_string($_POST['txt_user']);
        $email =  $conn->escape_string($_POST['txt_email']);

        $sql = "UPDATE tb_user SET  name='$name',email='$email' WHERE id='$id' ";

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
    if (!empty($_POST['txt_user'])) {

        $id = secureStr($_POST['id']);
        $name =  secureStr($_POST['txt_user']);
        $email = secureStr($_POST['txt_email']);

        $id = $conn->escape_string($_POST['id']);
        $name =  $conn->escape_string($_POST['txt_user']);
        $email =  $conn->escape_string($_POST['txt_email']);

        $sql = "INSERT INTO tb_user(name, email ) VALUES('$name', '$email')";

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
