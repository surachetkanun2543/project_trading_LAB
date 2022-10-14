<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>chart | journaltrading.tech </title>
  <link href="../css/dashboard.css" rel="stylesheet">

  <!-- Favicons -->
  <link rel="manifest" href="../assetsuser/img/favicons/site.webmanifest">
  <link rel="icon" href="../assets/img/logo.png" type="image/icon type">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="../assetsuser/img/favicons/browserconfig.xml">

  <!-- stylesheet -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../plugins/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
  <link rel="stylesheet" href="../assetsuser/css/adminlte.min.css">
  <link rel="stylesheet" href="../assetsuser/css/style.css">
  <!-- Datatables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">


  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png" />
  <!-- Custom CSS -->
  <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="../dist/css/style.min.css" rel="stylesheet" />

  <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Charts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
  <div class=" bg-transparent" style="background-image: url('https://images.unsplash.com/photo-1618853606785-bae61817cc7a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDh8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=800&q=60'); background-repeat: no-repeat; background-size: cover;">
    <div class="wrapper bg-transparent">
      <?php include_once('../pages/sidebar.php') ?>
      <div class="content-wrapper bg-transparent">
        <br>
        <div class="content-header ml-4">
          <div class="container-fluid">
            <div class="row">
              <div class="page-wrapper col-lg-3" style="border-radius:10px;">
                <div class=" col-lg-10 ">
                  <br>
                  <h4 class="ml-4 text-dark"> กราฟสินทรัพย์หลักทั่วโลก </h4>
                  <p class="ml-4 text-dark"> (World asset chart) </p>
                </div>
              </div>
              <br>
            </div>
          </div>
        </div>
        <main class="col-md-7 ml-sm-auto col-lg-12 px-md-3 py-4">
          <div class="row">
            <div class="col-12 col-xl-12 mb-4 mb-lg-0">
              <div class="card ml-4" style="border-radius:10px;">
                <div class="card-body text-right  bg-light elevation-3" style="border-radius:10px;">
                  <h5 class="ml-4 text-dark text-left">BTC/USDT TF 30M </h5>
                  <p class="ml-4 text-dark text-left"> ( update before refresh page | api by binance )</p>
                  <div class="card-body" id="tvchart"></div>
                  <button type="button " class="float-start text-light btn btn-success elevation-2 ml-4 mb-4" style="border-radius:8px;" onclick='window.location.reload(true);'> REFESH</button>
                </div>
              </div>
              <br><br>
            </div>
          </div>
        </main>
      </div>
      <br>
      <br>
    </div>

  </div>


</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
<script type="text/javascript" src="btc.js"></script>

</html>