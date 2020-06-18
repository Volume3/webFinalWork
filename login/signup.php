<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8">
  <title>Mismatch - Sign Up</title>
  <link rel="stylesheet" href="css/signup.css" />
</head>
<body>

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));

    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM user WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO user (username, password, join_date) VALUES ('$username', SHA('$password1'), NOW())";
        mysqli_query($dbc, $query);

        // Confirm success with the user
        echo '<p>用户已注册成功！点击以<a href="viewprofile.php">查看个人信息</a>.</p>';

        mysqli_close($dbc);
        exit();
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">用户名已被占用！</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">用户名或密码不可为空！</p>';
    }
  }

  mysqli_close($dbc);
?>

<div id="BackG"></div>
<div id="Medipng"></div>
<div id="Headline"></div>
<div id="Arrow"></div>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  
    <div id="MainPart">

      <!--背景区域!-->
      <div id="WhiteBackground">
        <div id="Shape_1"></div>
        <div id="Shape_2"></div>
        <div id="Shape_3"></div>
      </div>

      <!--提示信息!-->
      <div id="SignUpIntro">
        <h2>注册</h2>
      </div>
      <!--底部文字!-->
      <div id="LoginNow">
        <a href="login.php">登录</a>
      </div>

      <!--用户名输入框!-->
      <div id="Username_Field">
        <input type="text" id="username" name="username" placeholder="*请输入用户名" value="<?php if (!empty($username)) echo $username; ?>" autocomplete="off"/><br />
        <div id="User_Icon">
          <img src="images/User Icon.png" alt="">
        </div>
      </div>

      <!--密码输入框!-->
      <div id="Key_Field">
        <input type="password" id="password1" name="password1" placeholder="*请输入密码" autocomplete="off"/><br />
        <input type="password" id="password2" name="password2" placeholder="*请再次输入密码" autocomplete="off"/><br />
        <div id="Key_Icon1">
          <img src="images/theKey.png" alt="">
        </div>
        <div id="Key_Icon2">
          <img src="images/theKey.png" alt="">
        </div>
      </div>

      <div id="Mail_Field">
        <input type="text" id="mail" name="mail" placeholder="请输入邮箱" autocomplete="off">
        <div id="Mail_Icon">
          <img src="images/mail.png" alt="">
        </div>
      </div>

      <div id="Tel_Field">
        <input type="text" id="Tel" name="Tel" placeholder="请输入联系电话" autocomplete="off">
        <div id="Tel_Icon">
          <img src="images/Tel.png" alt="">
        </div>
      </div>

      <input type="submit" value="注&emsp;册" id="SignBtn" name="submit" />

    </div>
  </form>
</body> 
</html>
