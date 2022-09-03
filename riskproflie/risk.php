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
    <title> RISKPROFILE | <?php echo $user['name']; ?> </title>
    <link rel="icon" href="../assets/img/logo.png" type="image/icon type">
    <link href="../css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

</head>

<body>

    <?php
    $query =
        "SELECT tb_question.*,tb_score.id_question, sum(tb_score.score) 
                        as qtyscore ,count(tb_score.id_info) as qtyperson  
                        FROM tb_score 
                        LEFT JOIN tb_question 
                        ON tb_score.id_question = tb_question.id_question 
                        GROUP BY tb_score.id_question";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result)) {

    ?>
        <?
        $answer = (number_format(($row['qtyscore'] / $row['qtyperson']), 2));

        if ($answer >= 3.30) {
            echo "<script> window.location.href = 'risklevel3.php';</script>";
            // echo  "มาก";
        } else if ($answer >= 3.00) {
            echo "<script> window.location.href = 'risklevel2.php';</script>";
            // echo "กลาง";
        } else if ($answer >= 2.50) {
            echo "<script> window.location.href = 'risklevel1.php';</script>";
            // echo "น้อย";
        } else
            echo "<script> window.location.href = 'risklevel1.php';</script>";
        ?>

    <? } ?>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
</body>

</html>