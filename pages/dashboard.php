<?php
error_reporting(error_reporting() & ~E_NOTICE);
require '../service/user_connect.php';

$query = "SELECT * FROM tb_type ORDER BY Assettype_id asc" or die;
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | <?php echo $user['name']; ?> </title>
    <link rel="icon" href="../assets/img/logo.png" type="image/icon type">
    <link href="../css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light  bg-dark ">
        <a class="navbar-brand ml-3 text-light" href="#">
            <img src="../assets/img/logo.png" width="30" height="30" alt="">
            <span>จดบันทึกและวิเคราะห์การลงทุน | </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-light" href="dashboard.php">DASHBOARD<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="journal.php">JOURNAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="performance.php">PERFORMANCE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="report.php">REPORTING</a>
                </li>
            </ul>
            <div class="col-8 col-md-5 col-lg-9 d-flex align-items-center  justify-content-md-end mt-3 mt-md-0">
                <div class="dropdown text-light">
                    <button class="btn   text-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        สวัสดีตอนเย็นคุณ : <?php echo $user['name']; ?>
                        <img class="btn  dropdown-toggle" src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>" alt="img_user" width="60" height="45">
                    </button>

                    <ul class="dropdown-menu text-light" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Risk Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid  ">
        <div class="row">
            <main class="col-md-7 ml-sm-auto col-lg-12 px-md-3 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb col-lg-12">
                        <h1 class="breadcrumb-item ">DASHBOARD</h1>
                    </ol>
                    <br>
                </nav>
                <div class="row my-4 mb-6 ">
                    <div class="col-12 col-md-6 col-lg-3 mb-6 mb-lg-0">
                        <div class="card text-center">
                            <h3 class="card-header bg-info text-white">ACCUMULATIVE RETURN</h3>
                            <div class="card-body">
                                <!-- <h5 class="card-title"> <?php foreach ($result as $results) { ?>  <?php echo $results["Assettype_name"]; ?> <?php } ?></h5> -->
                                <br>
                                <br>
                                <h2 class="card-title text-success">+5,000 USD</h2>
                                <br>
                                <br>
                                <p class="card-text text-success">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-8 mb-lg-2 pb-3">
                        <div class="card text-center">
                            <h3 class="card-header bg-success text-white">WIN no.</h3>
                            <div class="card-body">
                            <br>
                                <br>
                                <h2 class="card-title">69 no.</h2>
                                <br>
                                <br>
                                <p class="card-text text-success">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card text-center">
                            <h3 class="card-header bg-danger text-white">LOSS no.</h3>
                            <div class="card-body">
                            <br>
                                <br>
                                <h2 class="card-title">20 no.</h2>
                                <br>
                                <br>
                                <p class="card-text text-success">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card text-center">
                            <h3 class="card-header bg-info text-white">TOTAL TRADERS</h3>
                            <div class="card-body">
                            <br>
                                <br>
                                <h2 class="card-title">160 no.</h2>
                                <br>
                                <br>
                                <p class="card-text text-success">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card text-center">
                            <h3 class="card-header bg-success text-white">RETURN FOR WIN</h3>
                            <div class="card-body">
                            <br>
                                <br>
                                <h2 class="card-title text-success ">+45,000 USD</h2>
                                <br>
                                <br>
                                <p class="card-text text-success">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card text-center">
                            <h3 class="card-header bg-danger text-white">RETURN FOR LOSS</h3>
                            <div class="card-body">
                            <br>
                                <br>
                                <h2 class="card-title text-danger">-3,000 USD</h2>
                                <br>
                                <br>
                                <p class="card-text text-success">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card text-center">
                            <h3 class="card-header bg-success text-white">AVG RETURN FOR WIN</h3>
                            <div class="card-body">
                            <br>
                                <br>
                                <h2 class="card-title text-success">+4,000 USD</h2>
                                <br>
                                <br>
                                <p class="card-text text-success">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card text-center">
                            <h3 class="card-header bg-danger text-white">AVG RETURN FOR LOSS</h3>
                            <div class="card-body">
                            <br>
                                <br>
                                <h2 class="card-title text-danger">-400 USD</h2>
                                <br>
                                <br>
                                <p class="card-text text-success">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- <footer class="pt-5 d-flex justify-content-between">
            <span>Copyright © 2022-2025 <> SURACHET</span>
            <ul class="nav m-0">
                <li class="nav-item">
                    <a class="nav-link text-secondary" aria-current="page" href="#">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="#">Terms and conditions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="#">Contact</a>
                </li>
            </ul>
        </footer> -->
        </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        new Chartist.Line('#traffic-chart', {
            labels: ['January', 'Februrary', 'March', 'April', 'May', 'June'],
            series: [
                [23000, 25000, 19000, 34000, 56000, 64000]
            ]
        }, {
            low: 0,
            showArea: true
        });
    </script>
    <script>
        new Chartist.Line('#traffic-chart2', {
            labels: ['January', 'Februrary', 'March', 'April', 'May', 'June'],
            series: [
                [23000, 25000, 19000, 34000, 56000, 64000]
            ]
        }, {
            low: 0,
            showArea: true
        });
    </script>
</body>

</html>