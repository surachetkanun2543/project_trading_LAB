<?php

header('Content-Type: application/json');

require_once '../../service/admin_connect.php';

$sqlQuery = "SELECT tb_type.Assettype_name as name , count(tb_type.Assettype_id) as number 
             FROM tb_type
             INNER JOIN tb_type  
             ON tb_type.Assettype_id = tb_type.Assettype_id
             GROUP BY tb_type.Assettype_id ORDER BY Assettype_id ASC";


$result =  mysqli_query($conn, $sqlQuery);

$data = array();

foreach ($result as $key => $row) {
    $data[] = $row;
}
mysqli_close($conn);

echo json_encode($data);
