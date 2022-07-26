<?php

header('Content-Type: application/json');

require_once '../../service/admin_connect.php';

$sqlQuery = "SELECT tbl_type.type_name as name , count(tbl_product.type_id) as number 
             FROM tbl_type
             INNER JOIN tbl_product  
             ON tbl_type.type_id = tbl_product.type_id
             GROUP BY tbl_product.type_id ORDER BY p_name ASC";


$result =  mysqli_query($conn, $sqlQuery);

$data = array();

foreach ($result as $key => $row) {
    $data[] = $row;
}
mysqli_close($conn);

echo json_encode($data);
