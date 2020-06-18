<?php
  require_once('connectvars.php');

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_COOKIE['user_id'])) {
    if (isset($_POST['submit'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // 获取用户输入的用户名和密码
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_username) && !empty($user_password)) {
        // 在数据库中查找对应的用户名和密码
        $query = "SELECT user_id, username FROM user WHERE username = '$user_username' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // 登录成功设置cookies
          $row = mysqli_fetch_array($data);
          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24));    // expires in 1 day
          setcookie('username', $row['username'], time() + (60 * 60 * 24));  // expires in 1 day
          // 获取当前域名
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/webFinalWork/workbench.html';
          //重定向到
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = '登陆用户名或密码不正确';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = '用户名或密码不可为空！';
      }
    }
  }
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Mismatch - Log In</title>
  <link rel="stylesheet" href="css/login.css" />
</head>
<body>

<?php
  if (empty($_COOKIE['user_id'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>
<div id="BackG"></div>
<div id="Medipng"></div>
<div id="Headline"></div>
<div id="Arrow"></div>
<!-- <img src="imgaes/medical.png" id="Medipng"> -->
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div id="MainPart">

      <!--背景区域!-->
      <div id="WhiteBackground">
        <div id="Shape_1"></div>
        <div id="Shape_2"></div>
        <div id="Shape_3"></div>
      </div>

      <!--右上角关闭图形!-->
      <div id="CloseBtn">
        <div id="delete"></div>
        <div id="delete_too">
          <img src="images/delete-too.png" alt="">
        </div>
      </div>

      <!--头像</!-->
      <div id="profphoto">
        <div id="Layer_3"></div>
        <div id="Me_copy"></div>
        <div id="theBackground"></div>
      </div>

      <!--用户名输入框!-->
      <div id="Username_Field">
        <input type="text" id="username" name="username" placeholder="请输入用户名" value="<?php if (!empty($user_username)) echo $user_username; ?>" autocomplete="off"/><br />
        <div id="Separator"></div>
        <div id="User_Icon">
          <img src="images/User Icon.png" alt="">
        </div>
      </div>

      <!--密码输入框!-->
      <div id="Key_Field">
        <input type="password" id="password" name="password" placeholder="请输入密码" autocomplete="off"/><br />
        <div id="Separator1"></div>
        <div id="Key_Icon">
          <img src="images/theKey.png" alt="">
        </div>
      </div>

      <!--忘记密码!-->
      <div id="Forget">
        忘记密码?
      </div>

      <!--底部文字!-->
      <div id="Register">
        <a href="signup.php">注册</a>
      </div>

      <input type="submit" value="登&emsp;录" id="submit" name="submit" />

    </div>
  </form>


<?php
  }
  else {
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_COOKIE['username'] . '.</p>');
  }
?>
</body>
</html>

