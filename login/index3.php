<?php
			  
	require_once('startsession.php');
	// require_once('appvars.php');
	// require_once('connectvars.php');

	if(isset($_SESSION['username'])){
        echo '<div class="Login">';
        echo '<a href="viewprofile.php" id="profile">个人信息</a>';
        echo '<a href="logout.php" id="logout">登出('. $_SESSION['username'] . ')</a>';
        echo '</div>';
    }
?>