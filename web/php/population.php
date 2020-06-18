<?php 
	$host="127.0.0.1";
	$username = "root";
	$password = "123456";
	$databaseName = "deliverroom";

	$dbc = mysqli_connect($host,$username,$password,$databaseName);
 	
 	$doc = "select * from doctor";
 	$mat = "select * from maternal";
 	$nur = "select * from nurse";

 	$data1 = mysqli_query($dbc,$doc);
 	$data2 = mysqli_query($dbc,$mat);
 	$data3 = mysqli_query($dbc,$nur);
 

    // if(mysql_num_rows($data)==1){
    $num1 = mysqli_num_rows($data1);
    $num2 = mysqli_num_rows($data2); 
 	$num3 = mysqli_num_rows($data3);
    //}
 	$json = array('doctor'=>$num1,'mate'=>$num2,'nur'=>$num3);
 	echo json_encode($json);
 	//echo ($name);
 ?>	
