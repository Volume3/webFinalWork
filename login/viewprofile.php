<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'View Profile';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8" />
  <title>查看个人信息</title>
  <link rel="stylesheet" href="css/viewprofile.css" />
</head>
<body>

<?php

  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">请先<a href="login.php">登录</a>。</p>';
    exit();
  }

  // Show the navigation menu
  //require_once('navmenu.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Grab the profile data from the database
  if (!isset($_GET['user_id'])) {
    $query = "SELECT username, telephone, email, gender, birthdate, realname, picture FROM user WHERE user_id = '" . $_SESSION['user_id'] . "'";
  }
  else {
    $query = "SELECT username, telephone, email, gender, birthdate, realname, picture FROM user WHERE user_id = '" . $_GET['user_id'] . "'";
  }
  $data = mysqli_query($dbc, $query);

   if (mysqli_num_rows($data) == 1) {
    // The user row was found so display the user data
    $row = mysqli_fetch_array($data);
    if (!empty($row['username'])) {
      echo '<div id="Username">' . $row['username'] . '</div>';
    }
    if(!empty($row['telephone'])) {
      echo '<div id="Telephone">联系电话：' . $row['telephone'] . '</div>';
    }
    if(empty($row['telephone'])) {
      echo '<div id="Telephone">联系电话：未填写</div>';
    }
    if(!empty($row['email'])) {
      echo '<div id="Email">常用邮箱：' . $row['email'] . '</div>';
    }
    if(empty($row['email'])) {
      echo '<div id="Email">常用邮箱：未填写</div>';
    }
    if (!empty($row['picture'])) {
      echo '<div id="Icon"><img src="' . MM_UPLOADPATH . $row['picture'] .
        '" alt="Profile Picture" /></div>';
    }
    if (empty($row['picture'])) {
      echo '<div id="Icon"><img src="images/UnIcon.png" alt="Profile Picture" /></div>';
    }
    echo '<div id="UserInfo" class="MainPart">';
    if (!empty($row['username'])) {
      echo '<div class="Info" id="Username1">用户名：' . $row['username'] . '</div>';
    }
    if(!empty($row['gender'])) {
      echo '<div class="Info" id="Gender">性别：';
      if($row['gender'] == 'M') {
        echo '男 </div>';
      }
      else if ($row['gender'] == 'F') {
        echo '女 </div>';
      }
    }
    if(empty($row['gender'])) {
      echo '<div class="Info" id="Gender">性别：未填写</div>';
    }
    if(!empty($row['telephone'])) {
      echo '<div class="Info" id="Telephone1">联系电话：' . $row['telephone'] . '</div>';
    }
    if(empty($row['telephone'])) {
      echo '<div class="Info" id="Telephone1">联系电话：未填写</div>';
    }
    if(!empty($row['email'])) {
      echo '<div class="Info" id="Email1">常用邮箱：' . $row['email'] . '</div>';
    }
    if(empty($row['email'])) {
      echo '<div class="Info" id="Email1">常用邮箱：未填写</div>';
    }
    if(!empty($row['birthdate'])) {
      echo '<div class="Info" id="Birthdate">出生年月：' . $row['birthdate'] . '</div>';
    }
    if(empty($row['birthdate'])) {
      echo '<div class="Info" id="Birthdate">出生年月：未填写</div>';
    }
    if(!empty($row['realname'])) {
      echo '<div class="Info" id="Realname">真实姓名：' . $row['realname'] . '</div>';
    }
    if(empty($row['realname'])) {
      echo '<div class="Info" id="Realname">真实姓名：未填写</div>';
    }
    if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
      echo '<div class="Info" id="Edit"><a href="editprofile.php">编 辑</a></div>';
    }
    echo '</div>';
  } // End of check for a single row of user results
  else {
    echo '<p class="error">There was a problem accessing your profile.</p>';
  }

  mysqli_close($dbc);
?>

<div id="nav"></div>
<div id="navNext"></div>
<div id="MainPart" class="MainPart">
    <div id="BaseIntro"></div>
    <div id="BaseInfo">
      <div id="FirstCol">
        <span id="theIntro">基础信息</span>
        <span id="Separator"></span>
      </div>
    </div>
</div>
</body> 
</html>

<?php
  // Insert the page footer
  //require_once('footer.php');
?>
