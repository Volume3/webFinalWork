<?php
    require_once('connect.php');

  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
    $query1 = "select mat_id, state from bed where bed_id = '{$_GET['bedId']}'";
	$data1 = mysqli_query($dbc, $query1);
	$row1 = mysqli_fetch_array($data1);
	if(mysqli_num_rows($data1)==1){
		if($row1['state']=='占用'){
		    $mat_id = $row1['mat_id'];
		    echo("<option selected>".$mat_id."</option>");
		}
		else if($row1['state']=='空闲'){
            $query2 = "select mat_id from maternal where maternal.condition is NULL or maternal.condition='转出病床'";
	        $data2 = mysqli_query($dbc, $query2);
	        echo("<option selected>请选择病历号</option>");
	        while($row2 = mysqli_fetch_array($data2)){
	            echo("<option>".$row2['mat_id']."</option>");
	        }
		}
	}

 //  	$query2 = "select mat_id from maternal";
	// $data2 = mysqli_query($dbc, $query2);
	// while($row2 = mysqli_fetch_array($data2)){
	//   if($row2['mat_id']==$mat_id)
	//     echo("<option selected>".$row2['mat_id']."</option>");
	//   else
	//     echo("<option>".$row2['mat_id']."</option>");
	// }

 ?>