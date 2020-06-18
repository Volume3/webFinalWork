<?php
  // Start the session
  require_once('startsession.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8" />
  <title>编辑个人信息</title>
  <link rel="stylesheet" href="css/editprofile.css" />
</head>
<body>

<?php
  error_reporting(0);
  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">请先<a href="login.php">登录</a>。</p>';
    exit();
  }

  //抓取数据库资料以显示
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
      echo '<div id="Username" >' . $row['username'] . '</div>';
    }
  } // End of check for a single row of user results
  else {
    echo '<p class="error">There was a problem accessing your profile.</p>';
  }

  //检查并提交资料
  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $telephone = mysqli_real_escape_string($dbc, trim($_POST['telephone']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
    $birthdate = mysqli_real_escape_string($dbc, trim($_POST['birthdate']));
    $realname = mysqli_real_escape_string($dbc, trim($_POST['realname']));
    $old_picture = mysqli_real_escape_string($dbc, trim($_POST['old_picture']));
    $new_picture = mysqli_real_escape_string($dbc, trim($_FILES['new_picture']['name']));
    $new_picture_type = $_FILES['new_picture']['type'];
    $new_picture_size = $_FILES['new_picture']['size']; 
    list($new_picture_width, $new_picture_height) = getimagesize($_FILES['new_picture']['tmp_name']);
    $error = false;

    // Validate and move the uploaded picture file, if necessary
    if (!empty($new_picture)) {
      if ((($new_picture_type == 'image/gif') || ($new_picture_type == 'image/jpeg') || ($new_picture_type == 'image/pjpeg') ||
        ($new_picture_type == 'image/png')) && ($new_picture_size > 0) && ($new_picture_size <= MM_MAXFILESIZE) &&
        ($new_picture_width <= MM_MAXIMGWIDTH) && ($new_picture_height <= MM_MAXIMGHEIGHT)) {
        if ($_FILES['file']['error'] == 0) {
          // Move the file to the target upload folder
          $target = MM_UPLOADPATH . basename($new_picture);
          if (move_uploaded_file($_FILES['new_picture']['tmp_name'], $target)) {
            // The new picture file move was successful, now make sure any old picture is deleted
            if (!empty($old_picture) && ($old_picture != $new_picture)) {
              @unlink(MM_UPLOADPATH . $old_picture);
            }
          }
          else {
            // The new picture file move failed, so delete the temporary file and set the error flag
            @unlink($_FILES['new_picture']['tmp_name']);
            $error = true;
            echo '<p class="error">Sorry, there was a problem uploading your picture.</p>';
          }
        }
      }
      else {
        // The new picture file is not valid, so delete the temporary file and set the error flag
        @unlink($_FILES['new_picture']['tmp_name']);
        $error = true;
        echo '<p class="error">Your picture must be a GIF, JPEG, or PNG image file no greater than ' . (MM_MAXFILESIZE / 1024) .
          ' KB and ' . MM_MAXIMGWIDTH . 'x' . MM_MAXIMGHEIGHT . ' pixels in size.</p>';
      }
    }

    //更新资料
    if (!$error) {
      if (!empty($telephone) && !empty($email) && !empty($gender) && !empty($birthdate) && !empty($realname)) {
        // Only set the picture column if there is a new picture
        if (!empty($new_picture)) {
          $query = "UPDATE user SET telephone = '$telephone', email = '$email', gender = '$gender', " .
            " birthdate = '$birthdate', realname = '$realname', picture = '$new_picture' WHERE user_id = '" . $_SESSION['user_id'] . "'";
        }
        else {
          $query = "UPDATE user SET telephone = '$telephone', email = '$email', gender = '$gender', " .
            " birthdate = '$birthdate', realname = '$realname' WHERE user_id = '" . $_SESSION['user_id'] . "'";
        }
        mysqli_query($dbc, $query);

        // Confirm success with the user
        echo '<p>修改已保存。 点击以<a href="viewprofile.php">查看你的资料。</a></p>';
        echo '<script type="text/javascript">document.getElementById("Username").style.display="none";</script>';
        mysqli_close($dbc);
        exit();
      }
      else {
        echo '<p class="error">You must enter all of the profile data (the picture is optional).</p>';


      }
    }
  } // End of check for form submission
  else {
    // Grab the profile data from the database
    $query = "SELECT telephone, email, gender, birthdate, realname, picture FROM user WHERE user_id = '" . $_SESSION['user_id'] . "'";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);

    if ($row != NULL) {
      $telephone = $row['telephone'];
      $email = $row['email'];
      $gender = $row['gender'];
      $birthdate = $row['birthdate'];
      $realname = $row['realname'];
      $old_picture = $row['picture'];
    }
    else {
      echo '<p class="error">There was a problem accessing your profile.</p>';
    }
  }

  mysqli_close($dbc);
?>

  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MM_MAXFILESIZE; ?>" />
      <?php if (!empty($old_picture)) {
        echo '<div id="Icon"><img src="' . MM_UPLOADPATH . $old_picture .
        '" alt="Profile Picture" /></div>';
      } 
      else {
        echo '<div id="Icon"><img src="images/UnIcon.png" alt="Profile Picture" /></div>';
      }?>
  <div id="MainPart">
      <div id="nav"></div>
      <div id="navNext"></div>
      <div id="BaseIntro">
        <span>(点击上传新头像)</span>
      </div>
      <input type="file" id="newIcon" name="new_picture" />
      <div id="BaseInfo">
        <div id="FirstCol">
          <span id="theIntro">基础信息</span>
          <span id="Separator"></span>
        </div>
        <div class="Info" id="Telephone">
          <label for="telephone">联系电话：</label>
          <input type="text" id="telephone" name="telephone" value="<?php if (!empty($telephone)) echo $telephone; ?>" />
        </div>
        <div class="Info" id="Email">
          <label for="email">常用邮箱：</label>
          <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email;?>" />
        </div>
        <div class="Info" id="Gender">
          <label for="gender">性别：&emsp;&emsp;</label>
          <select id="gender" name="gender">
            <option value="M" <?php if (!empty($gender) && $gender == 'M') echo 'selected = "selected"'; ?>>Male</option>
            <option value="F" <?php if (!empty($gender) && $gender == 'F') echo 'selected = "selected"'; ?>>Female</option>
          </select>
        </div>
        <div class="Info" id="Birthdate">
          <label for="birthdate">出生年月：</label>
          <input type="text" id="birthdate" name="birthdate" value="<?php if (!empty($birthdate)) echo $birthdate; else echo 'YYYY-MM-DD'; ?>" />
        </div>
        <div class="Info" id="Realname">
          <label for="realname">真实姓名：</label>
          <input type="text" id="realname" name="realname" value="<?php if (!empty($realname)) echo $realname; ?>" />
        </div>
      </div>
      <input type="submit" value="保 存" name="submit" id="Save" />
  </div>

  </form>
</body> 
</html>
