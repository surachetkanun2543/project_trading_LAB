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


?>

<script>

    $(document).ready(function() {
        let url =
        //86e39ef62737799b02baba7d418b3486
        //c16e7f3f6c19ab1d2fdbfdb9693d57e3
            "https://gnews.io/api/v4/search?q=crypto&token=86e39ef62737799b02baba7d418b3486&lang=en";

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
            <h4 class="text-dark btn btn-lg btn-warning"  style="border-radius:40px; ">ข่าวธุรกิจที่น่าสนใจวันนี้ : ${latestNews[i].description} : ข่าวเมื่อวันที่ :  ${latestNews[i].publishedAt}  </h4>
        `;
                    i++;
                }
                console.log('lastnews : ', output);


                if (output !== "") {
                    $("#newsResults").html(output);
                }
            },

            error: function() {
                let errorMsg = `<div class="errorMsg text-danger">gnews api Requests = 100 per day</div>`;
                $("#newsResults").html(errorMsg);
                console.log('errorMsg : ', errorMsg);
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
        background: transparent;
    }

    /* (B) MOVING TICKER WRAPPER */
    .hmove {
        display: flex;
        background: transparent;
    }

    /* (C) ITEMS - INTO A LONG HORIZONTAL ROW */
    .hitem {
        flex-shrink: 0;
        width: 100%;
        box-sizing: border-box;
        padding: 5px;
        text-align: center;
        background: transparent;
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
        animation: tickerh linear 190s infinite;
        background: transparent;

    }

    .hmove:hover {
        animation-play-state: paused;
    }

    .nav-link {
        border: none;
        outline: none;
        padding: 8px 13px;
        cursor: pointer;
        font-size: 16px;
    }

    .active,
    .nav-link:hover {
        background-color: green;
        color: black;
        border-radius:40px;
    }
  
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <!-- Navbar -->
    <nav class="main-header ">
        <a style="border-radius:40px;" class="nav-link " style="color:light;" data-widget="pushmenu" href="index.php"><i class="fas fa-bars"></i></a>
        <div class="hwrap ">
            <div class="hmove">
                <h4><div class=" hitem" id="newsResults"></div> </h4>
            </div>
        </div>
    </nav>
    <br>

    <div class="main-sidebar bg-transparent  elevation-5">
        <div class="user-panel mt-5 pb-2 mb-3 d-flex">
            <div class="image">
                &nbsp; &nbsp;<img src="../assets/img/logo.png" alt="Admin Logo" class="brand-image img-circle elevation-3"> &nbsp;
                <span class="font-weight-bold text-light" center>&nbsp; journaltrading.tech</span>
                <hr>
                <span class="font-weight-bold  text-light align=" center> &nbsp; &nbsp; &nbsp; ยินดีต้อนรับ &nbsp;</span>&nbsp;&nbsp; &nbsp; <img src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>" class=" img-circle elevation-3 alt=" User Image">
                <br>
                <br>
                <h4 class="logged-in text-success btn btn-outline-success " style="border-radius:40px;"> ● &nbsp;&nbsp;คุณ  &nbsp;<?php echo $user['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h4>
            </div>
        </div>
        <hr>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <div id="myDIV">
                    <li class="nav-item">
                        <a href="../dashboard/index.php" class="nav-link <?php echo isActive('dashboard') ?>">
                            <i class="text-success  fas fa-tachometer-alt"></i>&nbsp;&nbsp;
                            <p class="text-white "> | หน้าแรก </p>
                        </a>
                        <hr>
                    </li>
                </div>
                <li class="nav-item ">
                    <a href="../journal/index.php" class="nav-link <?php echo isActive('journal') ?>">
                        <i class="text-success  	fas fa-box-open"></i>&nbsp;&nbsp;
                        <p class="text-white "> | บันทึก</p>
                    </a>
                    <hr>
                </li>
                <li class="nav-item">
                    <a href="../performance/index.php" class="nav-link <?php echo isActive('performance') ?>">
                        <i class="text-success fas fa-chart-line"></i> &nbsp;&nbsp;
                        <p class="text-white "> | วิเคราะห์ </p>
                    </a>
                    <hr>
                </li>
                <li class="nav-item">
                    <a href="../report/index.php" class="nav-link <?php echo isActive('report') ?>">
                        <i class="text-success  fas fa-book-reader"></i>&nbsp;&nbsp;
                        <p class="text-white "> | รายงาน </p>
                    </a>
                    <hr>
                </li>
                <li class="nav-item">
                    <a href="../riskproflie/survey.php" id="" class="nav-link <?php echo isActive('riskproflie') ?>">
                        <i class="text-success 	far fa-address-card"></i> &nbsp;&nbsp;
                        <p class="text-white "> | ความเสี่ยง</p>
                    </a>
                    <hr>
                <li class="nav-item ">
                    <a href="../news/news.php" id="" class="nav-link  <?php echo isActive('news') ?>">
                        <i class="text-success	fas fa-comment-dots"></i> &nbsp;&nbsp;
                        <p class="text-white "> | ข่าว</p>
                    </a>
                    <hr>
                </li>

                <li class="nav-item ">
                    <a href="../chartbtc/index.php" id="" class="nav-link  <?php echo isActive('chartbtc') ?>">
                        <i class="text-warning fab fa-btc"></i>&nbsp;&nbsp;
                        <p class="text-warning "> | กราฟบิตคอย์น</p>
                    </a>
                    <hr>
                </li>
                <li class="nav-item ">
                    <a href="../chartxau/index.php" id="" class="nav-link  <?php echo isActive('chartxau') ?>">
                        <i class="text-warning 	fas fa-database"></i>&nbsp;&nbsp;
                        <p class="text-warning "> | กราฟทองคำ</p>
                    </a>
                    <hr>
                </li>
                <li class="nav-item ">
                    <a href="../profliesetting/index.php" id="" class="nav-link  <?php echo isActive('profilesetting') ?>">
                        <i class="text-success 	fab fa-creative-commons-by"></i>&nbsp;&nbsp;
                        <p class="text-white "> | ตั้งค่าโปรไฟล์</p>
                    </a>
                    <hr>
                </li>
                <br>
                <li class="nav-item  btn btn-outline-dark text-danger" style="border-radius:40px;">
                    <a href="logout.php" id="" class=" btn btn "  onclick="return confirm('ยืนยันออกจากระบบ ?')">
                        <i class=" text-danger fas fa-sign-out-alt "></i> &nbsp; | ออกจากระบบ
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <br><br>
</body>

</html>