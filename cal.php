<?php
error_reporting(0);
extract($_POST);
if (isset($save)) {

    $startdate = $_POST['startdate']; // $_POST['startdate'] 
    $enddate = $_POST['enddate']; // $_POST['enddate']
    $name = $_POST['name']; // $_POST['name'] 
    $type = $_POST['type']; // $_POST['name'] 

    $N = $_POST['n1'] * $_POST['n2'];
    $Y = $_POST['y1'] * $_POST['y2'];

    //ถ้าราคาขายมากกว่าราคาซื้อ  กำไร
    if ($Y > $N) {
        //ราคาขายลบราคาต้นทุน
        $p = $Y - $N;

        //หาเปอร์เซ็น
        $pp = ($p * 100) / $N;

        // $name = " <p style='color:blue';>  " . " ชื่อ = " . $name . " " . "</p>";

        //แสดงเงินกำไร
        $res .= " <p style='color:green';>  " . " กำไร = " . $p . " บาท" . "</p>";

        //แสดงเปอร์เซ้นกำไร
        $ress .= "<p style='color:green';>  " . " คิดเป็น = " .  $pp .  " %" .  "<p>";

        //แสดงวันที่ถือครองสินทรัพย์
        //$period_of_times .= "จำนวนวันที่ถือครอง  = " . $period_of_time .  " วัน" .  "<p>";


        //ถ้าราคาซื้อมากกว่าราคาขาย ขาดทุน
    } else {
        //ราคาต้นทุนลบราคาขาย
        $l = $N - $Y;

        //หาเปอร์เซ็น
        $lp = ($l * 100) / $N;

        //$name = " <p style='color:blue';>  " . " ชื่อ = " . $name . " " . "</p>";

        //แสดงเงินขาดทุน
        $res .= " <p style='color:red';>  " . " กำไร = " . $l . " บาท" . "</p>";

        //แสดงเปอร์เซ้นกำไร
        $ress .= "<p style='color:red';>  " . " คิดเป็น = " .  $lp .  " %" .  "<p>";
        //แสดงวันที่ถือครองสินทรัพย์
        //$period_of_times .= " จำนวนวันที่ถือครอง  = " . $period_of_time .  " วัน" .  "<p>";
    }
}

$earlier = new DateTime($startdate);
$later = new DateTime($enddate);

// $now = strtotime($startdate); // or your date as well
// $your_date = strtotime($enddate);
// $datediff = $now - $your_date;
// echo ($datediff / (24 * 60 * 60)   );
//echo $pos_diff = $earlier->diff($later)->format("%r%a"); //3
//echo $datediff = $enddate->diff($startdate)->format("%a");
//echo $pos_diff = $startdate->diff($enddate)->format("%r%a");


?>
<!DOCTYP html>
    <html>

    <head>
        <title>Profit and Loss</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
        </script>
    </head>

    <body>
        <div class="container">
            <br>

            <center>
                <h3>คำนวณ กำไร / ขาดทุน สินทรัพย์</h3>
            </center>
            <hr>
            <form method="post">
                <div class="form-group">

                    <table class="table">

                        <br>
                        <tr>
                            <th>Enter your Type (หมวดหมู่สินทรัพย์)</th>
                            <th><input class="form-control" type="text" name="type" value="<?php echo $type; ?>" /></th>
                        </tr>
                        <tr>
                            <th>Enter your Name (ชื่อสินทรัพย์)</th>
                            <th><input class="form-control" type="text" name="name" value="<?php echo $name; ?>" /></th>
                        </tr>
                        <tr>
                            <th>Enter your Cost Price (ราคาซื้อ)</th>
                            <th><input class="form-control" type="number" name="n2" value="<?php echo $n2; ?>" /></th>
                        </tr>
                        <tr>
                            <th>Enter your Cost stock (จำนวนสินทรัพย์ที่ซื้อ)</th>
                            <th><input class="form-control" type="number" name="n1" value="<?php echo $n1; ?>" /></th>
                        </tr>
                        <tr>
                            <th>Date buy (วันเดือนปีที่ซื้อ)</th>
                            <th> <input class="form-control" id="startdate" name="startdate" type="date" placeholder="2022-08-31" /></th>
                        </tr>

                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>

                        <tr>
                            <th>Enter your Cost stock (จำนวนสินทรัพย์ที่ขาย)</th>
                            <th><input class="form-control" type="number" name="y1" value="<?php echo $y1; ?>" /></th>
                        </tr>
                        <tr>
                            <th>Enter your Selling Price (ราคาขาย)</th>
                            <th><input class="form-control" type="number" name="y2" value="<?php echo $y2; ?>" /></th>
                        </tr>
                        <tr>
                            <th>Date sell (วันเดือนปีที่ขาย)</th>
                            <th> <input class="form-control" id="enddate" name="enddate" type="date" placeholder="2022-08-31" /></th>
                        </tr>

                        <tr>

                            <th colspan="5">
                                <input class="btn btn-primary" type="submit" name="save" value="วิเคราะห์" />
                            </th>
                        </tr>
                        <tr>
                            <th>ผลการวิเคราะห์ : </th>

                            <th style="color:blue;">
                                <p style="color:blue;"><?php echo $type; ?></p>
                                <p style="color:blue;"><?php echo $name; ?></p>
                                <p style="color:blue;"><?php echo $res; ?></p>
                                <p style="color:blue;"><?php echo $ress; ?></p>
                                <p style="color:blue;">จำนวนวันถือครอง : <?php echo $pos_diff = $earlier->diff($later)->format("%r%a"); ?> วัน </p>
                            </th>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </body>

    </html>