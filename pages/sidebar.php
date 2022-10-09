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

function isActive($data)
{
    $array = explode('/', $_SERVER['REQUEST_URI']);
    $key = array_search("pages", $array);
    $name = $array[$key + 1];
    return $name === $data ? 'active' : '';
}




# print the JSON response from SerpWow
//  echo $api_result;
?>

<script>
    $(document).ready(function() {
        let url =
            "https://newsapi.org/v2/everything?q=bitcoin&apiKey=b8f05f1231a04c0d922fc7b795116047";

        $.ajax({
            url: url,
            method: "GET",
            dataType: "JSON",

            success: function(newsdata) {
                let output = "";
                let latestNews = newsdata.articles;
                var i = 1

                while (output <= i) {

                    output += `
ื
            <span class="text-light"  style="font-size:16px"  title="${latestNews[i].title}"> เว็บไซต์จดบันทึกและวิเคราะห์การลงทุน : ข่าวที่น่าสนใจวันนี้ :  ${latestNews[i].title} : เว็บไซต์พัฒนาโดย สุรเชษฐ์ กันอุ่น © © 2022 Copyright: journaltrading.tech.  </span>
        `;
                    i++;
                }
                console.log('lastnews : ', output);

                if (output !== "") {
                    $("#newsResults").html(output);
                }
            },

            error: function() {
                let errorMsg = `<div class="errorMsg center">Some error occured</div>`;
                $("#newsResults").html(errorMsg);
            },
        });
    });

    $(document).ready(function() {
        function refresh() {
            var div = $('#hwrap'),
                divHtml = div.class();

            div.html(divHtml);
        }

        setInterval(function() {
            refresh()
        }, 100000); //300000 is 5minutes in ms
    })
</script>

<style>
    .logged-in {
        color: green;
    }

    /* (A) FIXED WRAPPER */
    .hwrap {
        overflow: hidden;
        /* HIDE SCROLL BAR */
        background: #eee;
    }

    /* (B) MOVING TICKER WRAPPER */
    .hmove {
        display: flex;
    }

    /* (C) ITEMS - INTO A LONG HORIZONTAL ROW */
    .hitem {
        flex-shrink: 0;
        width: 100%;
        box-sizing: border-box;
        padding: 5px;
        text-align: center;
    }

    /* (D) ANIMATION - MOVE ITEMS FROM RIGHT TO LEFT */
    /* 4 ITEMS -400%, CHANGE THIS IF YOU ADD/REMOVE ITEMS */
    @keyframes tickerh {
        0% {
            transform: translate3d(100%, 0, 0);
        }

        100% {
            transform: translate3d(-400%, 0, 0);
        }
    }

    .hmove {
        animation: tickerh linear 70s infinite;

    }

    .hmove:hover {
        animation-play-state: paused;
    }
</style>
<!-- Navbar -->
<nav class="main-header  navbar-secondary  ">
    <a class="nav-link bg-dark" data-widget="pushmenu" href="index.php"><i class="fas fa-bars"></i></a>
    <div class="hwrap bg-secondary">
        <div class="hmove bg-secondary">
            <div class="text-light bg-secondary hitem" id="newsResults"></div>
        </div>
    </div>
</nav>

<div class="main-sidebar bg-gradient-dark elevation-5">
    <div class="user-panel mt-5 pb-2 mb-3 d-flex">
        <div class="image">
            &nbsp; &nbsp;<img src="../assets/img/logo.png" alt="Admin Logo" class="brand-image img-circle elevation-3"> &nbsp;
            <span class="font-weight-bold" center>&nbsp; journaltrading.tech</span>
            <hr>
            <span class="font-weight-bold align=" center> &nbsp; &nbsp; &nbsp; ยินดีต้อนรับ &nbsp;</span>&nbsp;&nbsp; &nbsp; <img src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>" class=" img-circle elevation-3 alt=" User Image">
            <br>
            <br>
            <h4 class="logged-in text-success"> ● &nbsp; &nbsp;<?php echo $user['name']; ?> </h4>
        </div>
    </div>
    <hr>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="../dashboard/index.php" class="nav-link <?php echo isActive('dashboard') ?>">
                    <i class="text-success nav-icon fas fa-tachometer-alt"></i>&nbsp;&nbsp;
                    <p class="text-white "> DASHBOARD </p>
                </a>
                <hr>
            </li>
            <li class="nav-item">
                <a href="../journal/index.php" class="nav-link <?php echo isActive('journal') ?>">
                    <i class="text-success nav-icon fas fa-user-cog"></i>&nbsp;&nbsp;
                    <p class="text-white ">JOURNAL</p>
                </a>
                <hr>
            </li>
            <li class="nav-item">
                <a href="../performance/index.php" class="nav-link <?php echo isActive('performance') ?>">
                    <i class="text-success fas fa-store"></i> &nbsp;&nbsp;&nbsp;
                    <p class="text-white "> PERFORMANCE </p>
                </a>
                <hr>
            </li>
            <li class="nav-item">
                <a href="../report/index.php" class="nav-link <?php echo isActive('report') ?>">
                    <i class="text-success nav-icon fas fa-newspaper"></i>
                    <p class="text-white ">REPORT </p>
                </a>
                <hr>
            </li>
            <li class="nav-item">
                <a href="../riskproflie/survey.php" id="" class="nav-link <?php echo isActive('riskproflie') ?>">
                    <i class="text-success fas fa-sign"></i> &nbsp;&nbsp;
                    <p class="text-white ">RISK PROFILE</p>
                </a>
                <hr>
            <li class="nav-item ">
                <a href="../profliesetting/index.php" id="" class="nav-link  <?php echo isActive('profilesetting') ?>">
                    <i class="text-success nav-icon fas fa-user-cog"></i>
                    <p class="text-white ">PROFILE SETTING</p>
                </a>
                <hr>
            <li class="nav-item ">
                <a href="../news/index.php" id="" class="nav-link  <?php echo isActive('news') ?>">
                    <i class="text-success fas fa-sign"></i>&nbsp;&nbsp;
                    <p class="text-white ">NEWS</p>
                </a>
                <hr>
            </li><br>
            <li class="nav-item btn btn-outline-danger bg-dark">
                <a href="logout.php" id="logout" class="nav-link "></a>
                <i class=" text-danger fas fa-sign-out-alt"></i>
                <p class=" text-danger " href="logout.php" onclick="return confirm('ยืนยันออกจากระบบ ?');">LOGOUT</p>
            </li>
        </ul>
    </nav>
</div>
</aside>