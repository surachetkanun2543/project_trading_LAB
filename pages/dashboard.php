<?php
error_reporting(error_reporting() & ~E_NOTICE);
require '../service/user_connect.php';

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
            <div class="collapse navbar-collapse " id="navbarNav">
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
                            สวัสดีตอนเที่ยงคุณ : <?php echo $user['name']; ?>
                            <img class="btn  dropdown-toggle" src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>" alt="img_user" width="60" height="45">
                        </button>

                        <ul class="dropdown-menu text-light" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="survey.php">Risk Profile</a></li>
                            <li><a class="dropdown-item" href="profilesettings.php">Profile Settings</a></li>
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
                </nav>
                <div class="row my-4 mb-6 ">
                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0 ">
                        <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                            <h3 class="card-header bg-success text-white">WIN no.</h3>
                            <div class="card-body">
                                <br>
                                <br>
                                <h1 class="card-title text-success">69 no.</h1>
                                <br>
                                <br>
                                <p class="card-text text-success">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0 ">
                        <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                            <h3 class="card-header bg-danger text-white">LOSS no.</h3>
                            <div class="card-body">
                                <br>
                                <br>
                                <h1 class="card-title text-danger">40 no.</h1>
                                <br>
                                <br>
                                <p class="card-text text-danger">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-1 mb-lg-0 ">
                        <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                            <h3 class="card-header bg-success text-white">RETURN FOR WIN</h3>
                            <div class="card-body">
                                <br>
                                <br>
                                <h1 class="card-title text-success ">+45,000 USD</h1>
                                <br>
                                <br>
                                <p class="card-text text-success">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-1 mb-lg-0 ">
                        <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                            <h3 class="card-header bg-danger text-white">RETURN FOR LOSS</h3>
                            <div class="card-body">
                                <br>
                                <br>
                                <h1 class="card-title text-danger">-3,000 USD</h1>
                                <br>
                                <br>
                                <p class="card-text text-danger">18.2% increase since last month</p>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="d-flex justify-content-around mb-3  ">
        <div class="col-4 col-xl-4 ">
            <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                <h3 class="card-header bg-info text-white">RETURN FOR LOSS</h3>
                <div class="card-body">
                    <canvas id="doughnut-chart" width="150" height="150"></canvas>
                </div>
            </div>
        </div>

        <div class="col-3 col-xl-3 ">
            <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                <h3 class="card-header bg-info text-white">RETURN FOR LOSS</h3>
                <div class="card-body">
                    <canvas id="doughnut-chart-2" width="150" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        new Chart(document.getElementById("doughnut-chart"), {
            type: 'doughnut',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                    data: [2478, 5267, 734, 784, 433]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
            }
        });
        new Chart(document.getElementById("doughnut-chart-2"), {
            type: 'doughnut',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                    data: [2478, 5267, 734, 784, 433]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
            }
        });
    </script>
</body>
<footer class="bg-dark text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-white p-3">
        © 2022 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">SURACHET KANUN จดบันทึกและวิเคราะห์การลงทุน </a>
    </div>
    <!-- Copyright -->
</footer>

</html>