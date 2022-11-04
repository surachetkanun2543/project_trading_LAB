<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

require '../service/user_connect.php';


$query = "SELECT * FROM `tb_type` ORDER BY `tb_type`.`Assettype_id` ASC";
$result = mysqli_query($conn, $query);

if (!isset($_SESSION['login_id'])) {
    header('Location: ./index.php');
    exit;
}
$id = $_SESSION['login_id'];
$get_user = mysqli_query($db_connection, "SELECT * FROM `tb_user` WHERE `google_id`='$id'");
if (mysqli_num_rows($get_user) > 0) {
    $user = mysqli_fetch_assoc($get_user);
} else {
    header('Location: logout.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PROFILE SETTING | <?php echo $user['name']; ?> </title>
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



    <script>
        $(document).ready(function() {
            let url =
                "https://gnews.io/api/v4/search?q=crypto&token=86e39ef62737799b02baba7d418b3486&lang=en";

            $.ajax({
                url: url,
                method: "GET",
                dataType: "JSON",

                beforeSend: function() {
                    $(".progress").show();
                },

                complete: function() {
                    $(".progress").hide();
                },

                success: function(newsdata) {
                    let output = "";
                    let latestNews = newsdata.articles;

                    for (var i in latestNews) {
                        // console.log(latestNews[i].media[0]["media-metadata"][2].url);
                        // console.log("-------------------------------------------------------");   testing for finding the image src url
                        // console.log(latestNews[i].media[0]);
                        output += `
<center>
     <div class="col-lg-11" >
<div   class="card" style="border-radius:50px; background: linear-gradient(0deg, rgba(45,44,44,0.7413340336134453) 20%, rgba(40,38,38,0.6713060224089635) 100%);">

<br>
<button type="button" class=" bg-transparent text-light btn btn-success mb-3  text-left  " style="border-radius:40px;"> สำนักข่าว :  ${latestNews[i].source.name} </button>

<div class="card-image mt-3">
       <img style="600px; width:500px; border-radius:25px;" src= "${latestNews[i].image}" class = "responsive-img"
alt = "${latestNews[i].source}" >
     </div>
    <div class="card-content">
    <h3 class="card-body text-light" >  ${latestNews[i].title} </h3>
    </h5>
    <p> 
    <a class="card-body text-light"  href="${latestNews[i].url}" title="${latestNews[i].content}">${latestNews[i].content}</a>
    </p>
    </div>
    <p style="color:gray; border-radius:35px;background: linear-gradient(0deg, rgba(11,10,10,0.5116421568627452) 20%, rgba(10,9,9,0.4780287114845938) 100%);" href="${latestNews[i].url}" title="${latestNews[i].publishedAt}">${latestNews[i].publishedAt}</p>
   </div>
  </div>
  </center>
`;

                    }
                    console.log('lastnews : ', latestNews);

                    if (output !== "") {
                        $("#Results").html(output);
                    }
                },

                error: function() {
                    let errorMsg = `<div class="errorMsg text-danger">gnews api Requests = 100 per day</div>`;
                    $("#Results").html(errorMsg);
                },
            });
        });
    </script>



<body class="hold-transition sidebar-mini">

<div class=" bg-transparent" style="background-image: url('https://images.unsplash.com/photo-1617224908579-c92008fc08bb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'); background-repeat: no-repeat; background-size: cover;">
    <!-- <div class=" bg-transparent" style="background-image: url('https://img.freepik.com/free-photo/abstract-luxury-gradient-blue-background-smooth-dark-blue-with-black-vignette-studio-banner_1258-108740.jpg?w=1380&t=st=1665642113~exp=1665642713~hmac=295ceedd5a8378dda40b0dfdbd53c266b9f1580eddc0fdba2ca7fb81d545495d'); background-repeat: no-repeat; background-size: cover;"> -->
        <div class="wrapper bg-transparent">
            <?php include_once('../pages/sidebar.php') ?>
            <div class="content-wrapper  bg-transparent">
                <br>
                <div class="content-header ml-4">
                    <div class="container-fluid">
                        <div class="row">
                        <div class=" elevation-3 bg-dark col-lg-3" style="border-radius:35px;background: linear-gradient(0deg, rgba(11,10,10,0.5116421568627452) 20%, rgba(10,9,9,0.4780287114845938) 100%);">
                                <div class=" col-lg-10 ">
                                    <br>
                                    <h4 class="ml-4 text-light"> ข่าวธุรกิจทั่วโลก </h4>
                                    <p class="ml-4 text-light"> (world business news ) </p>

                                </div>
                            </div>
                            <br> <br>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div id="Results"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- SCRIPTS -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assetsuser/js/adminlte.min.js"></script>


    <!-- OPTIONAL SCRIPTS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <script src="../assetsuser/js/pages/dashboard.js"></script>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
</body>

</html>