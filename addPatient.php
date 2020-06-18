<?php
  //require_once('appvars.php');
  require_once('PHP/connect.php');

  define('GW_UPLOADPATH', 'images/');
  
  $bed_id = $_POST['bed_id'];
  $mat_id = $_POST['mat_id'];
  $condition = $_POST['condition'];
  $date = $_POST['date'];
  $screenshot = $_FILES['screenshot']['name'];

  // 定义新的文件名及路径（确保文件名不重复）
  $screenshot = time().$screenshot;        
  $target = GW_UPLOADPATH.$screenshot;
  // 把文件移到目标文件夹中
  if(move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)){
    // 连接数据库
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // 将要执行的SQL语句
    //$query="INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score', '$screenshot')";
    $query1="UPDATE maternal SET picture='".$screenshot."', maternal.condition='".$condition."', maternal.date='".$date."' WHERE mat_id='".$mat_id."'";
    $query2="UPDATE bed SET state='占用', mat_id='".$mat_id."' WHERE bed_id ='".$bed_id."'";
    // 执行数据库操作
    mysqli_query($dbc, $query1);
    mysqli_query($dbc, $query2);
    // 关闭数据库连接
    mysqli_close($dbc);

    // 转换成json格式返回
    $json=array('status'=>'success', 'mat_id'=>$mat_id, 'target'=>$target);
    echo json_encode($json);
    //echo ("success");
  }
  else{ // 如果文件移动失败，提示信息以json格式返回
    $msg = 'sorry, there was a problem uploading your screen shot image.';
    echo json_encode(array('status'=>'fail', 'message'=>$msg));
  }

  @unlink($_FILES['screenshot']['tmp_name']);

?>