<?php
	require_once('db.php');
	$db="table_dimensions";
	$con =  new mysqli($servername,$username,$password,$db);
	if($con->connect_error){
		die("connection failed".$con->connect_error);
	}
	$sql= "SELECT * FROM tbl_dimensions";
	$res = $con->query($sql);
?>             