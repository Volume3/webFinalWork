<?php 
	$host="127.0.0.1";
	$username = "root";
	$password = "123456";
	$databaseName = "deliverroom";

	$dbc = mysqli_connect($host,$username,$password,$databaseName);
 	
 	$a1 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=1";
 	$a2 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=2";
 	$a3 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=3";
 	$a4 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=4";
 	$a5 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=5";
 	$a6 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=6";
 	$a7 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=7";
 	$a8 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=8";
 	$a9 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=9";
 	$a10 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=10";
 	$a11 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=11";
 	$a12 = "SELECT DATE_FORMAT(date,'%c') FROM maternal WHERE DATE_FORMAT(date,'%c')=12";

 	$data1 = mysqli_query($dbc,$a1);
 	$data2 = mysqli_query($dbc,$a2);
 	$data3 = mysqli_query($dbc,$a3);
 	$data4 = mysqli_query($dbc,$a4);
 	$data5 = mysqli_query($dbc,$a5);
 	$data6 = mysqli_query($dbc,$a6);
 	$data7 = mysqli_query($dbc,$a7);
 	$data8 = mysqli_query($dbc,$a8);
 	$data9 = mysqli_query($dbc,$a9);
 	$data10 = mysqli_query($dbc,$a10);
 	$data11 = mysqli_query($dbc,$a11);
 	$data12 = mysqli_query($dbc,$a12);
 

    // if(mysql_num_rows($data)==1){
    $num1 = mysqli_num_rows($data1);
    $num2 = mysqli_num_rows($data2); 
 	$num3 = mysqli_num_rows($data3);
 	$num4 = mysqli_num_rows($data4);
    $num5 = mysqli_num_rows($data5); 
 	$num6 = mysqli_num_rows($data6);
 	$num7 = mysqli_num_rows($data7);
    $num8 = mysqli_num_rows($data8); 
 	$num9 = mysqli_num_rows($data9);
 	$num10 = mysqli_num_rows($data10);
    $num11 = mysqli_num_rows($data11); 
 	$num12 = mysqli_num_rows($data12);

    //}
 	$json = array('m1'=>$num1,'m2'=>$num2,'m3'=>$num3,'m4'=>$num4,'m5'=>$num5,'m6'=>$num6,'m7'=>$num7,'m8'=>$num8,'m9'=>$num9,'m10'=>$num10,'m11'=>$num11,'m12'=>$num12);
 	echo json_encode($json);
 	//echo ($name);
 ?>	
