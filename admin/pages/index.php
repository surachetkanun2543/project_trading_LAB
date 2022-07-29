<!DOCTYPE html>
<html>

<head>

  <?php
  include "check.php";
  include "../../service/admin_connect.php";

  $query = "SELECT COUNT(*) AS SUM FROM tbl_admin ORDER BY admin_id" or die;
  $result1 = mysqli_query($conn, $query);

  $query = "SELECT COUNT(*) AS SUM FROM tb_user ORDER BY id" or die;
  $result2 = mysqli_query($conn, $query);

  $query = "SELECT COUNT(*) AS SUM FROM tb_type ORDER BY Assettype_id" or die;
  $result3 = mysqli_query($conn, $query);

  // $query = "SELECT COUNT(p_id) AS SUM FROM tbl_product ORDER BY p_id" or die;
  // $result5 = mysqli_query($conn, $query);

  ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="20; url="<?php echo $_SERVER['PHP_SELF']; ?>"> -->
    <title>หน้าแรก - Admin Dashboard</title>
    <link rel="icon" href="../../assets/img/logo.png" type="image/icon type">
    <link href="../css/hrader-1.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="icon" href="https://www.flaticon.com/svg/static/icons/svg/353/353343.svg" />
    

    <script>
      $(document).ready(function() {
        swal({
          position: 'top-left',
          buttons: false,
          title: 'ยินดีต้อนรับเข้าสู่',
          text: "หน้าแรก",
          timer: 700
        })
        showGraph();
      });

      function showGraph() {
        $.post('chart_db.php', function(data) {
          console.log(data);
          let name = [];
          let id = [];


          for (let i in data) {
            name.push(data[i].name);
            id.push(data[i].number);
          }

          let chartdata = {
            labels: name,
            datasets: [{
              label: 'จำนวน ',
              backgroundColor: ["#282838"],
              // hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"],

              borderColor: [
                '#3F4E4F',
              ],
              // borderCapStyle: 'butt',
              borderColor: '#3F4E4F',
              borderJoinStyle: 'miter',
              fill: true,
              borderWidth: 3,
              pointBackgroundColor: '#000010',
              pointBorderColor: 'RGB(242, 243, 245)',
              pointBorderWidth: 10,
              pointHoverBorderWidth: 4,
              pointHitRadius: 1,
              pointRadius: 3,
              pointHoverRadius: 4,
              pointStyle: 'doughnut',

              data: id
            }]
          };

          let graphTarget = $('#graphCanvas');
          let barGraph = new Chart(graphTarget, {
            type: 'line',
            data: chartdata
          })
        });
      }
    </script>
    <nav>
      <?php include 'nav.php'
      ?>
      <?php echo exec('whoami'); ?>
    </nav>
  </head>

<body>
  <div class="container">
    <div class="row m-5 col-12 p-3 ">
      <main class="col-12 m-3 ml col-lg-10 px-md-4 py-1">
        <h1 class="h1 text-black font-weight-bold">หน้าแรก</h1>
        <p class="text-black">Admin Dashboard - รายงานภาพรวมของเว็บไซต์</p>
        <hr />
        <div class="row my-4">
          <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card">
              <h5 class="card-header text-black font-weight-normal">จำนวนแอดมิน</h5>
              <div class="card-body">
                <div class="h2 card-title">
                  <?php
                  foreach ($result1 as $results) { ?>
                    <h1 value="<?php echo $results["admin_id"]; ?>">
                      <h1><?php echo $results["SUM"]; ?> คน</h1>
                    </h1>
                  <?php }
                  ?>
                </div>
                <hr />
                <a href="admin.php" class="card-text text-seconds ">รายละเอียด</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card">
              <h5 class="card-header  text-black font-weight-normal">จำนวนสมาชิก</h5>
              <div class="card-body">
                <div class="h2 card-title">
                  <?php
                  foreach ($result2 as $results) { ?>
                    <h1 value="<?php echo $results["id"]; ?>">
                      <h1><?php echo $results["SUM"]; ?> คน</h1>
                    </h1>
                  <?php }
                  ?>
                </div>
                <hr />
                <a href="member.php" class="card-text text-seconds ">รายละเอียด</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card">
              <h5 class="card-header text-black font-weight-normal">หมวดหมู่สินทรัพย์</h5>
              <div class="card-body">
                <div class="h2 card-title">
                  <?php
                  foreach ($result3 as $results) { ?>
                    <h1 value="<?php echo $results["Assettype_id"]; ?>">
                      <h1><?php echo $results["SUM"]; ?> หมวด</h1>
                    </h1>
                  <?php }
                  ?>
                </div>
                <hr />
                <a href="type.php" class="card-text text-seconds ">รายละเอียด</a>
              </div>
            </div>
          </div>
          <!-- <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
            <div class="card">
              <h5 class="card-header text-black font-weight-normal">ประเมินความเสี่ยง</h5>
              <div class="card-body">
                <div class="h2 card-title">
                  <?php
                  foreach ($result5 as $results) { ?>
                    <h1 value="<?php echo $results["p_id"]; ?>">
                      <h1><?php echo $results["SUM"]; ?> แบบ </h1>
                    </h1>
                  <?php }
                  ?>
                </div>
                <hr />
                <a href="#" class="card-text text-seconds ">รายละเอียด</a>
              </div>
            </div>
          </div> -->
          <div class="h1"></div>
          <div class="h1"></div>
          <div class="col-12 ">
            <div class="card">
              <h5 class="card-header  text-black font-weight-normal">สินทรัพย์ที่มีผู้ใช้มากที่สุด</h5>
              <div class="card-body">
                <canvas id="graphCanvas" < />
              </div>
            </div>
          </div>
      </main>
    </div>
  </div>
  </div>
</body>

</html>