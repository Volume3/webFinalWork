<?php
    require_once('connect.php');

  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
    $query1 = "select mat_id, state from bed where bed_id = '{$_GET['bedId']}'";
	$data1 = mysqli_query($dbc, $query1);
	$row1 = mysqli_fetch_array($data1);
	if(mysqli_num_rows($data1)==1){
		if($row1['state']=="占用")
		    $mat_id = $row1['mat_id'];
		else if($row1['state']=="空闲"){
            echo("<option selected><p>请选择分娩情况</p></option>");
            echo("<option><p>分娩中</p></option>");
            echo("<option><p>产后观察</p></option>");
		}
	}

  	$query2 = "select maternal.condition from maternal where mat_id='".$mat_id."'";
	$data2 = mysqli_query($dbc, $query2);
	$row2 = mysqli_fetch_array($data2);
	if(mysqli_num_rows($data2)==1){
	  if($row2['condition']=='分娩中'){
	    echo("<option selected>分娩中</option>");
	    echo("<option>产后观察</option>");
	  }
	  else if($row2['condition']=='产后观察'){
        echo("<option>分娩中</option>");
	    echo("<option selected>产后观察</option>");
	  }
	}

 ?>