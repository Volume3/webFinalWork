<?php 

  define('DB_HOST', '127.0.0.1');
  define('DB_USER', 'root');
  define('DB_PASSWORD', '123456');
  define('DB_NAME', 'deliverroom');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
  // Retrieve the user data from MySQL
  $query = "SELECT bed_id, state, rank FROM bed WHERE bed_id='01'";
  $data = mysqli_query($dbc, $query);

  $row = mysqli_fetch_array($data);
  if(mysqli_num_rows($data)==1){
  	$mat_id = $row['bed_id'];
  	$name = $row['state'];
  	$age = $row['rank'];
  }

  echo ("<P>住院号: ".$mat_id."</p>");
  echo ("<P>姓名: ".$name."</p>");
  echo ("<P>年龄: ".$age."</p>");

?>