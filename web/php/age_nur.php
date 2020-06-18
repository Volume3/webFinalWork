<?php 
	$host="127.0.0.1";
	$username = "root";
	$password = "123456";
	$databaseName = "deliverroom";

	$dbc = mysqli_connect($host,$username,$password,$databaseName);
 	
 	$age1 = "select * from nurse where age>=15 and age<25";
 	$age2 = "select * from nurse where age>=25 and age<35";
 	$age3 = "select * from nurse where age>=35 and age<45";
 	$age4 = "select * from nurse where age>=45";

 	$data1 = mysqli_query($dbc,$age1);
 	$data2 = mysqli_query($dbc,$age2);
 	$data3 = mysqli_query($dbc,$age3);
 	$data4 = mysqli_query($dbc,$age4);
 

    // if(mysql_num_rows($data)==1){
    $num1 = mysqli_num_rows($data1);
    $num2 = mysqli_num_rows($data2); 
 	$num3 = mysqli_num_rows($data3);
 	$num4 = mysqli_num_rows($data4);
    //}
 	$json = array('n_age1'=>$num1,'n_age2'=>$num2,'n_age3'=>$num3,'n_age4'=>$num4);
 	echo json_encode($json);
 	//echo ($name);
 ?>	
