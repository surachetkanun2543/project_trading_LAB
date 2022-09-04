
<?php

header('Content-Type: application/json');

require_once '../../service/admin_connect.php';

$sqlQuery = "SELECT tb_type.Assettype_name as name , count(tb_journal.Assettype_name) as number FROM tb_type INNER JOIN tb_journal ON tb_type.Assettype_id = tb_journal.Assettype_name GROUP BY tb_journal.Assettype_name ORDER BY id ASC";


$result =  mysqli_query($conn, $sqlQuery);

$data = array();

foreach ($result as $key => $row) {
    $data[] = $row;
}
mysqli_close($conn);

echo json_encode($data);