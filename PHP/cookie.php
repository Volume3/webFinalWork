<?php  
function cookie(){
	require_once('startsession.php');
	require_once('appvars.php');
	require_once('connectvars.php');

			   // 产生导航菜单
	if(isset($_SESSION['username'])){
		echo '<a href="logout.php">登出('. $_SESSION['username'] . ')</a>';
	}
	else{
	    echo '<div class="Login">';
		echo '<a href="login.php">登录</a>&ensp;|&ensp;';
		echo '<a href="signup.php">注册</a>';
		echo '</div>';
	}
}
?>
