<?
error_reporting(0);
ini_set('display_errors', 0);
require '../service/user_connect.php';
	
// INSERT TABLE tb_roomreserv	

	$query = "INSERT INTO tb_info(created,gender,age,education,status) VALUES ('".date("d-m-Y H:i:s")."','".$_POST["rdo_gender"]."','". $_POST["rdo_age"] ."','".$_POST["rdo_education"]."','".$_POST["rdo_state"]."')";
    $result = mysqli_query($conn, $query);


	if($query)
	{

		//SELECT id_info

		$strSQL3 = "SELECT id_info FROM tb_info ORDER BY id_info  DESC LIMIT 1"; 

		$objQuery3 = mysqli_query($conn, $strSQL3);
		$objResult3 = mysqli_fetch_array($objQuery3);
		if(!$objResult3)
		{
			$id_info  = 1;
		}
		else
		{
			$id_info  = $objResult3["id_info"];

	}
	}
	else
	{
	echo "Error Save tb_info 	 [".$strSQL."]";
	}

	for($i=1;$i<=8;$i++) 
		{			
				if($_POST["radionNo".$i] != "") 
			{								
				
					// INSERT TABLE calendar
					$query = "INSERT INTO tb_score  ";
					$query .="(id_info,id_question,score) VALUES ('".$id_info."','". $i ."','".$_POST["radionNo".$i]."')";
					mysqli_query($conn, $query);

			}
		}	


			echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=risk.php'>";
