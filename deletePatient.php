<?php
  //require_once('appvars.php');
  require_once('PHP/connect.php');
  
  $bed_id = $_POST['bed_id'];
  $mat_id = $_POST['mat_id'];

    // 将要执行的SQL语句
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //$query="INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score', '$screenshot')";
  $query1="UPDATE maternal SET maternal.condition='转出病床' WHERE mat_id='".$mat_id."'";
  $query2="UPDATE bed SET state='空闲', mat_id=null WHERE bed_id ='".$bed_id."'";
    // 执行数据库操作
  mysqli_query($dbc, $query1);
  mysqli_query($dbc, $query2);
    // 关闭数据库连接
  mysqli_close($dbc);
?>