
<?php

header('Content-Type: application/json');

require_once '../../service/admin_connect.php';

$sqlQuery = "SELECT tb_type.Assettype_name as name , count(tb_journal.tb_type) as number FROM tb_type INNER JOIN tb_journal ON tb_type.Assettype_id = tb_journal.tb_type GROUP BY tb_journal.tb_type ORDER BY id ASC";


$result =  mysqli_query($conn, $sqlQuery);

$data = array();

foreach ($result as $key => $row) {
    $data[] = $row;
}
mysqli_close($conn);

echo json_encode($data);