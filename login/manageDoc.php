<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/managedoc.css">
	<link rel="stylesheet" href="css/pagination.css">
	<link rel="stylesheet" href="css/myPagination.css">
</head>
<body>
	<div class="page">
		<div class="header">
      <h2><img src="../images/logo.png" id="logo"></h2>
      <div class="ul">
          <ul class="nav nav-tabs">
            <li class=""><a class="NotSelect" id="LinkActionOff" href="../workbench.html">工作台</a></li>
            <li class="active"><a class="IsSelect" id="LinkActionOn" href="">人员信息管理</a></li>
            <li class=""><a class="NotSelect" id="LinkActionOff" href="../web/text.html">床位信息管理</a></li>
            <li class=""><a class="NotSelect" id="LinkActionOff" href="../web/message.html">信息汇总平台</a></li>
          </ul>
        </div>
        <div class="administrator">
          <div class="picture">
            <img src="../images/icon.png" alt="" id="pespic">
          </div>
        </div>
        <div id="personal">
            
        </div>
    </div>
		<div id="chooseCol">
      <span>选择</span><span>人员</span><br>
			<a href="managedoc.php" id="doc">医生</a><br>
			<a href="manageNur.php">护士</a><br>
			<a href="manageMat.php">孕妇</a><br>
		</div>
		<div id="divtest"></div>
    <div id="pager" class="quotes"></div>
    <div id="bg" style="display: none;" onclick="hide()"></div>
    <div id="Operation">
      <span>操作</span>
    </div>
    <div id="EditBtn" onclick="showE()" >
      <span>编辑</span>
    </div>
  	<div id="Edit" style="display: none">
  		<div id="Eintro">
  			<span>修改信息</span>
    		<button type="button" class="close" onclick="hide()">
    			<span aria-hidden="true">×</span>
    		</button>
  		</div>
  		<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  			<div id="EInput" id="">
            <label for="doc_id">工号：</label>
            <input type="text" id="doc_id" name="doc_id" /><br><br>
	          <label for="name">姓名：</label>
	          <input type="text" id="name" name="name" /><br><br>
	          <label for="sex">性别：</label>
	          <input type="text" id="sex" name="sex" /><br><br>
	          <label for="age">年龄：</label>
	          <input type="text" id="age" name="age" /><br><br>
	          <label for="direction">科室：</label>
	          <input type="text" id="direction" name="direction" /><br><br>
	          <label for="phone">联系电话：</label>
	          <input type="text" id="phone" name="phone" /><br><br>
            <input type="submit" value="保 存" name="EditInfo" id="EditInfo" />
	      </div>
  		</form>
    </div>
    <?php 
      error_reporting(0);
      require_once('connectvars.php');

      // Clear the error message
      $error_msg = "";

      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      mysqli_set_charset($dbc, 'utf8');

      //检查并提交资料
      if (isset($_POST['EditInfo'])) {
        // Grab the profile data from the POST
        $doc_id = mysqli_real_escape_string($dbc, trim($_POST['doc_id']));
        $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
        $sex = mysqli_real_escape_string($dbc, trim($_POST['sex']));
        $age = mysqli_real_escape_string($dbc, trim($_POST['age']));
        $direction = mysqli_real_escape_string($dbc, trim($_POST['direction']));
        $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));

        if (!empty($doc_id) && !empty($name) && !empty($sex) && !empty($age) && !empty($direction) && !empty($phone)) {
          $query = "SELECT * FROM doctor WHERE doc_id = '$doc_id'";
          $data = mysqli_query($dbc, $query);
          if (mysqli_num_rows($data) == 1) {
            // The doc_id is unique, so insert the data into the database
            $query = "UPDATE doctor SET name = '$name', sex = '$sex', age = '$age', " .
              " direction = '$direction', phone = '$phone' WHERE doc_id = '$doc_id'";
            mysqli_query($dbc, $query);

            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/managedoc.php';
            //重定向到
            header('Location: ' . $home_url);

            mysqli_close($dbc);
            exit();
          }
        }
      }
    ?>
    	
    <div id="DeleteBtn" onclick="showD()" >
      <span>删除</span>
    </div>
    <div id="Delete" style="display: none">
      <div id="Dintro">
        <span>删 除</span>
        <button type="button" class="close" onclick="hide()">
          <span aria-hidden="true">×</span>
        </button>
        <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div id="DInput">
            <label for="ID">工号：</label>
            <input type="text" name="doc_id" id="doc_id">
            <input type="submit" value="删 除" name="DeleteInfo" id="DeleteInfo" />
          </div>
        </form>
        <?php 
          require_once('connectvars.php');

          // Clear the error message
          $error_msg = "";

          // Connect to the database
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

          //检查并提交资料
          if (isset($_POST['DeleteInfo'])) {
            // Grab the profile data from the POST
            $doc_id = mysqli_real_escape_string($dbc, trim($_POST['doc_id']));

            $error = false;

            // Update the profile data in the database
            // if (!$error) {
              if (!empty($doc_id)) {
                // $query = "SELECT doc_id from doctor where doc_id = '$doc_id'";
                // $data = mysqli_query($dbc, $query);
                // if (mysqli_num_rows($data) == 1) {
                  $query1 = "DELETE FROM doctor WHERE doc_id = '$doc_id'";
                  mysqli_query($dbc, $query1);
                  
                  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/managedoc.php';
                  //重定向到
                  header('Location: ' . $home_url);
                  //echo "<div id='hint' ><p>已删除！</p></div>";
                }
              // }
              mysqli_close($dbc);
              exit();
            // }
          }
        ?>
        </div>
      </div>
      <div id="AddBtn" onclick="showA()" >
        <span>增加</span>
      </div>
      <div id="Add" style="display: none">
        <div id="Aintro">
          <span>增加信息</span>
          <button type="button" class="close" onclick="hide()">
            <span aria-hidden="true">×</span>
          </button>
          
          <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div id="AInput">
              <label for="ID">工号：</label>
              <input type="text" name="doc_id"><br><br>
              <label for="name">姓名：</label>
              <input type="text" id="name" name="name"/><br><br>
              <label for="sex">性别：</label>
              <input type="text" id="sex" name="sex"/><br><br>
              <label for="age">年龄：</label>
              <input type="text" id="age" name="age"/><br><br>
              <label for="direction">科室：</label>
              <input type="text" id="direction" name="direction" /><br><br>
              <label for="phone">联系电话：</label>
              <input type="text" id="phone" name="phone" /><br><br>
              <input type="submit" value="增 加" name="AddInfo" id="AddInfo" />
            </div>
          </form>
        </div>
        <?php 
          //error_reporting(0);
          require_once('connectvars.php');

          // Clear the error message
          $error_msg = "";

          // Connect to the database
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
          mysqli_set_charset($dbc, 'utf8');

          //检查并提交资料
          if (isset($_POST['AddInfo'])) {
            // Grab the profile data from the POST
            $doc_id = mysqli_real_escape_string($dbc, trim($_POST['doc_id']));
            $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
            $sex = mysqli_real_escape_string($dbc, trim($_POST['sex']));
            $age = mysqli_real_escape_string($dbc, trim($_POST['age']));
            $direction = mysqli_real_escape_string($dbc, trim($_POST['direction']));
            $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));

            if (!empty($doc_id) && !empty($name) && !empty($sex) && !empty($age) && !empty($direction) && !empty($phone)) {
              $query = "SELECT * FROM doctor WHERE doc_id = '$doc_id'";
              $data = mysqli_query($dbc, $query);
              if (mysqli_num_rows($data) == 0) {
                //The doc_id is unique, so insert the data into the database
                $query = "INSERT INTO doctor (doc_id, name, sex, age, direction, phone) VALUES ('$doc_id', '$name', '$sex', '$age', '$direction', '$phone' )";
                mysqli_query($dbc, $query);
                mysqli_close($dbc);
                $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/managedoc.php';
                //重定向到
                // header('Location: ' . $home_url);
                echo '<script>window.location.href="'.$home_url.'";</script>';
                exit();
              }
            }
          }
        ?>
      </div>
	</div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/jquery.pagination.js"></script>
	<script src="js/myPaginationDoc.js"></script>
  <script src="js/abc.js"></script>
</body>
</html>