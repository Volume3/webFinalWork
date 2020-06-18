<?php
	 $host="127.0.0.1";
	 $username = "root";
	 $password = "123456";
	 $databaseName = "deliverroom";


	$dbc = mysqli_connect($host, $username, $password, $databaseName);

	$id = $_POST['id'];
	$title = $_POST['title'];
	$keywords = $_POST['keywords'];
	$autor = $_POST['autor'];
	$add = $_POST['addt'];

	mysqli_query($dbc, "UPDATE bed SET state='$title',rank='$keywords',mat_id='$autor',nur_id='$add' WHERE bed_id='$id'");
	// mysqli_query($dbc, "UPDATE bed INNER JOIN ON nurse set bed.nur_id=nurse.id WHERE nurse.name = '$addt");
	// $query2="UPDATE bed SET state='占用', mat_id='".$mat_id."' WHERE bed_id ='".$bed_id."'";

	header("Location:../text.html");
	mysqli_close($dbc);
?>