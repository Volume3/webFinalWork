<?php 
	if(isset($_POST["index"])){
  		$pageIndex = $_POST["index"];
	}
	if(isset($_POST["size"])){
  		$pageSize = $_POST["size"];
	}

	$host = "127.0.0.1";   // 服务器地址 
    $username = "root";   // 用户名
    $password = "";  // 密码
    $databaseName = "deliverroom";  // 数据库名
	
	// 首次查询，只需要得到记录数量即可
	if($pageIndex==0){
		$query = "select count(*) from doctor";
		// 连接数据库
		$conn = db_connection($host, $username, $password, $databaseName);
		// 执行查询操作
		$result = $conn->query($query);

		echo json_encode(array("total"=>mysqli_fetch_array($result)['0']));
	}
	else{
		// 设置偏移记录数，即设置开始行号
		$startRowNum = ($pageIndex-1) * $pageSize;  
		$numOfRows = $pageSize;  // 返回的最多行数
		$query = "select * from doctor order by doc_id asc limit ".$startRowNum.",". $numOfRows;
		
		// 连接数据库
		$conn = db_connection($host, $username, $password, $databaseName);
		// 执行查询操作
		$result = $conn->query($query);

		$doctor = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
	        array_push($doctor, $row);
		}

		echo json_encode($doctor);
	}
	
	function db_connection($host, $username, $password, $databaseName){
        $conn = mysqli_connect($host, $username, $password, $databaseName);
        // 下面两条语句用来防止中文乱码
    	mysqli_query($conn,"set character set 'utf8'");
		mysqli_query($conn,"set names 'utf8'");
        if (mysqli_connect_errno()) {
     		echo "Could not connect to database.";
     		exit();
        }
        return $conn; // 返回连接对象
    }

 ?>
