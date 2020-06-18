<?php

  require_once('connect.php');
  
  bed();
  //cookie();

  function bed(){

	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	  $query = "select bed.bed_id, bed.state, maternal.name, maternal.mat_id, maternal.condition, maternal.date
	            from bed LEFT JOIN maternal on bed.mat_id = maternal.mat_id where bed.bed_id = '{$_GET['temp']}'";
	  $data = mysqli_query($dbc, $query);
	  $row = mysqli_fetch_array($data);
	  if(mysqli_num_rows($data)==1){
	  	$bed_id = $row['bed_id'];
	  	$state = $row['state'];
	  	$name = $row['name'];
	  	$mat_id = $row['mat_id'];
	    $condition = $row['condition'];
	    $date = $row['date'];
	  }
	  $json=array('state'=>$state, 'bed_id'=>$bed_id, 'name'=>$name, 'mat_id'=>$mat_id, 'condition'=>$condition, 'date'=>$date);
	  echo json_encode($json);
 }

?>