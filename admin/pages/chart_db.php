<?php

header('Content-Type: application/json');

require_once '../../service/admin_connect.php';

$sqlQuery = "SELECT tb_assettype.Assettype_name as name , count(tbl_product.Assettype_id) as number 
             FROM tb_assettype
             INNER JOIN tbl_product  
             ON tb_assettype.Assettype_id = tbl_product.Assettype_id
             GROUP BY tbl_product.Assettype_id ORDER BY p_name ASC";


$result =  mysqli_query($conn, $sqlQuery);

$data = array();

foreach ($result as $key => $row) {
    $data[] = $row;
}
mysqli_close($conn);

echo json_encode($data);
