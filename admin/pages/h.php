<?php
error_reporting(error_reporting() & ~E_NOTICE);
session_start();
include('../../service/admin_connect.php');

//แสดงชื่อผู้ใช้ที่เจ้าสู่ระบบทุกหน้าใน navber
$admin_id = ($_SESSION['admin_id']);
$admin_name = ($_SESSION['admin_name']);


?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>จดบันทึกและวิเคราะห์การลงทุน</title>
<link href="../css/s.css" rel="stylesheet" />
<link rel="icon" href="../assets/img/logo.png" type="image/icon type">
<link rel="icon" href="https://www.flaticon.com/svg/static/icons/svg/353/353343.svg" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>



<style>
  nav {
    height: 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    /* border: 1px solid red; */
    color: #fff;
    position: relative;
    z-index: 10;
  }

  body {
    font-family: 'Roboto Mono', monospace;
    height: 100%;
    background: url('https://translatesongstudio.com/wp-content/uploads/2018/09/white-background-4.jpg') no-repeat;
    background-size: cover;
    background-position: center;
    position: relative;
  }

  .navbar-toggler {
    overflow: hidden;
    background-color: #495C83;
    position: fixed;
    top: 0;
    width: 100%;
    color: lightgray;
  }

  .footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: red;
    color: #F1F1F1;
    text-align: center;
    background: rgb(0,0,0);
background: linear-gradient(122deg, rgba(0,0,0,1) 0%, rgba(104,103,147,1) 100%);
  }

  .table-table-striped {
    font-size: 25px;
  }
</style>


<!-- Footer -->
<!-- Copyright -->
<div class="footer page-footer font-small flex-shrink-0 py-2  text-white-100">
  <div class="container text-center">
    <small>จัดทำขึ้นเพื่อประกอบรายวิชา project2 &copy; เริ่มเขียนวันที่ 20 Jul 2022</small>
    <!-- <div class="footer-copyright text-center py-2">เริ่มเขียนวันที่ 9 ตุลาคม 2563</div> -->
  </div>
</div>
<!-- Copyright -->
<!-- Footer -->